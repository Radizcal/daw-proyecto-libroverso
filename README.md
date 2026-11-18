# Libroverso

Libroverso es una aplicación web que fomenta el hábito de la lectura mediante un sistema de gamificación. Los usuarios podrán registrar sus lecturas, ganar experiencia, subir de nivel y personalizar su personaje con recompensas virtuales.

## Autoría

- Autora: Raquel Díaz Carrasco
- Familia profesional: Informática y Comunicaciones
- Ciclo formativo: Grado Superior en Desarrollo de Aplicaciones Web
- Curso: 2.º DAW Virtual
- Centro: CIFP Avilés
- Curso académico: 2026/2027

## Tecnologías previstas

- Backend: PHP y Laravel
- Frontend: Vue.js, HTML, CSS y JavaScript
- Base de datos: MySQL
- ORM y migraciones: Eloquent
- Control de versiones: Git y GitHub

## Funcionalidades previstas

- Registro, inicio y cierre de sesión.
- Base de datos y gestión de los libros de cada usuario.
- Registro de páginas leídas y cálculo del progreso.
- API REST con las cuatro capas requeridas.
- Roles de usuario y administrador.
- Interfaz web funcional y despliegue público con HTTPS.
- Experiencia y niveles.
- Personaje con nivel, vida y monedas.
- Recompensa al subir de nivel.
- Catálogo de objetos estéticos 


## Tablero del proyecto

La planificación y seguimiento del desarrollo se realizan mediante un tablero Kanban de GitHub Projects.

Tablero: https://github.com/users/Radizcal/projects/1/views/1

Repositorio: https://github.com/Radizcal/daw-proyecto-libroverso

## Reconstrucción de la base de datos

El proyecto utiliza migraciones de Laravel y seeders para crear la estructura de la base de datos e insertar los datos iniciales de prueba.

Para reconstruir la base de datos desde cero, se debe ejecutar el siguiente comando desde la raíz del proyecto:

composer db:reset

Este comando realiza automáticamente las siguientes operaciones:

Elimina las tablas existentes de la base de datos.

Ejecuta todas las migraciones para crear de nuevo las tablas.

Ejecuta los seeders para insertar los datos iniciales de prueba.

Importante: este comando elimina los datos existentes de la base de datos antes de reconstruirla. Debe utilizarse teniendo en cuenta que cualquier dato que no esté incluido en los seeders se perderá.