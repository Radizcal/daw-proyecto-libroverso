# Documentación de la API de Libroverso

## 1. Descripción

Libroverso dispone de una API REST desarrollada con Laravel 12 y Eloquent ORM.

La API permite gestionar el catálogo de libros, las bibliotecas personales, las sesiones de lectura, los personajes y los objetos cosméticos y sus inventarios.

Todas las rutas están versionadas bajo el prefijo `/api/v1`.

## 2. URL base

Durante el desarrollo local:

`http://127.0.0.1:8000/api/v1`

## 3. Autenticación

La API utiliza Laravel Sanctum mediante sesiones y cookies. No utiliza tokens Bearer.

Para realizar peticiones autenticadas desde Postman:

1. Ejecutar `GET /sanctum/csrf-cookie`.
2. Conservar las cookies recibidas.
3. Iniciar sesión mediante `POST /api/v1/login`.
4. Enviar las cookies de sesión en las siguientes peticiones.
5. Para las peticiones que modifican datos, enviar la cabecera `X-XSRF-TOKEN` con el valor decodificado de la cookie `XSRF-TOKEN`.

Las peticiones deben incluir `Accept: application/json` y, cuando envíen JSON, `Content-Type: application/json`.

### Inicio de sesión

**POST** `/api/v1/login`

Cuerpo JSON:

```json
{
    "name": "user1",
    "password": "user123"
}
```

### Cierre de sesión

**POST** `/api/v1/logout`

Requiere autenticación.

## 4. Endpoints disponibles

Todas las rutas requieren autenticación, excepto el inicio de sesión.

| Método | Endpoint | Descripción | Permisos |
|---|---|---|---|
| GET | `/books` | Consultar libros | Usuario autenticado |
| GET | `/books/{id}` | Consultar un libro | Usuario autenticado |
| POST | `/books` | Crear un libro | Administrador |
| PUT/PATCH | `/books/{id}` | Actualizar un libro | Administrador |
| DELETE | `/books/{id}` | Eliminar un libro | Administrador |
| GET | `/my-books` | Consultar biblioteca personal | Usuario autenticado |
| GET | `/my-books/{id}` | Consultar un libro de la biblioteca | Usuario autenticado |
| POST | `/my-books` | Añadir un libro | Usuario autenticado |
| PUT/PATCH | `/my-books/{id}` | Actualizar un libro de la biblioteca | Usuario autenticado |
| DELETE | `/my-books/{id}` | Eliminar un libro de la biblioteca | Usuario autenticado |
| GET | `/reading-sessions` | Consultar sesiones de lectura | Usuario autenticado |
| POST | `/reading-sessions` | Registrar una sesión | Usuario autenticado |
| GET | `/character` | Consultar personaje | Usuario autenticado |
| GET | `/cosmetic-items` | Consultar objetos cosméticos | Usuario autenticado |
| GET | `/inventory` | Consultar inventario | Usuario autenticado |
| POST | `/inventory` | Comprar un objeto | Usuario autenticado |
| PATCH | `/inventory/{id}` | Equipar o desequipar un objeto | Usuario autenticado |

## 5. Códigos de respuesta HTTP

La API utiliza los siguientes códigos de estado:

- **200 OK:** operación realizada correctamente.
- **201 Created:** recurso creado correctamente.
- **204 No Content:** operación realizada sin contenido de respuesta.
- **400 Bad Request:** solicitud incorrecta.
- **401 Unauthorized:** falta autenticación o las credenciales no son válidas.
- **403 Forbidden:** el usuario no tiene permisos suficientes.
- **404 Not Found:** recurso inexistente o no accesible.
- **409 Conflict:** conflicto con el estado actual del recurso.
- **422 Unprocessable Content:** los datos enviados no superan la validación.
- **500 Internal Server Error:** error interno del servidor.

## 6. Formato de errores

Los errores de la API siguen el estándar RFC 9457 (Problem Details).

Las respuestas utilizan el tipo de contenido `application/problem+json` e incluyen información como:

- `type`: tipo de problema.
- `title`: título del error.
- `status`: código HTTP.
- `detail`: descripción del error.
- `instance`: ruta de la petición.
- `errors`: errores de validación, cuando corresponda.

## 7. Pruebas con Postman

La colección de peticiones se encuentra en:

`docs/api/Libroverso.postman_collection.json`

Contiene los siguientes grupos:

- Autenticación.
- Libros.
- Mi biblioteca.
- Sesiones de lectura.
- Personaje.
- Tienda.
- Inventario.

La colección permite probar los distintos endpoints de la API durante el desarrollo.
