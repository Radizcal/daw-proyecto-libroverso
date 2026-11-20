
<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();

        // Registrar el middleware de administración.
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // Formato RFC 9457 para los errores de la API.
        $exceptions->render(function (Throwable $exception, Request $request) {

            // Solo aplicar este formato a las rutas de la API.
            if (! $request->is('api/*')) {
                return null;
            }

            $status = 500;
            $title = 'Internal Server Error';
            $detail = 'An unexpected error occurred.';
            $errors = null;

            // Error de validación.
            if ($exception instanceof ValidationException) {
                $status = 422;
                $title = 'Unprocessable Content';
                $detail = 'The submitted data is invalid.';
                $errors = $exception->errors();
            }

            // Usuario no autenticado.
            elseif ($exception instanceof AuthenticationException) {
                $status = 401;
                $title = 'Unauthorized';
                $detail = 'Authentication is required.';
            }

            // Usuario sin permisos.
            elseif ($exception instanceof AuthorizationException) {
                $status = 403;
                $title = 'Forbidden';
                $detail = 'You do not have permission to perform this action.';
            }

            // Registro inexistente.
            elseif ($exception instanceof ModelNotFoundException) {
                $status = 404;
                $title = 'Not Found';
                $detail = 'The requested resource was not found.';
            }

            // Otros errores HTTP.
            elseif ($exception instanceof HttpExceptionInterface) {
                $status = $exception->getStatusCode();
                $title = Response::$statusTexts[$status] ?? 'HTTP Error';

                if ($status === 404) {
                    $detail = 'The requested resource was not found.';
                } elseif ($status >= 500) {
                    $detail = 'An unexpected error occurred.';
                } else {
                    $detail = $title;
                }
            }

            // Construir la respuesta Problem Details.
            $problem = [
                'type' => 'about:blank',
                'title' => $title,
                'status' => $status,
                'detail' => $detail,
                'instance' => $request->getPathInfo(),
            ];

            // Añadir los errores de validación cuando existan.
            if ($errors !== null) {
                $problem['errors'] = $errors;
            }

            return response()->json(
                $problem,
                $status,
                ['Content-Type' => 'application/problem+json']
            );
        });

    })->create();
