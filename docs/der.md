# Modelo entidad-relación (DER) — Libroverso

## 1. Introducción

Este documento recoge el diseño lógico de la base de datos de Libroverso, una aplicación web gamificada cuyo objetivo es fomentar el hábito de lectura mediante el registro del progreso lector, la obtención de experiencia, la subida de niveles y la adquisición de elementos estéticos.

El modelo relacional está diseñado siguiendo las reglas de normalización hasta la Tercera Forma Normal (3FN), con el objetivo de evitar redundancias y garantizar la integridad de los datos.

Se establecen siete tablas principales:

- `users`
- `books`
- `user_books`
- `reading_sessions`
- `characters`
- `cosmetic_items`
- `inventory_items`

## 2. Diagrama entidad-relación

El modelo contempla las siguientes relaciones:

+ Un usuario puede tener varios libros en su biblioteca personal.
+ Un libro puede pertenecer a las bibliotecas de varios usuarios.
+ Un libro puede tener varias sesiones de lectura registradas por un usuario.
+ Cada usuario dispone de un único personaje.
+ Un personaje puede tener varios elementos en su inventario.
+ Un elemento estético puede pertenecer al inventario de distintos personajes.

<img width="1536" height="1024" alt="Diagrama DER de Libroverso" src="https://github.com/user-attachments/assets/869f87b1-0cf3-4d6e-8f5d-fd3950ebdb5b" />

## 3. Tablas

### 3.1. Tabla `users`

Almacena la información de los usuarios registrados en la aplicación.

**Justificación:**

La tabla permite identificar a los usuarios y gestionar su acceso a la aplicación. El campo `id` actúa como clave primaria. El nombre de usuario debe ser único para evitar cuentas duplicadas y se utiliza también durante el inicio de sesión.

El campo `password` almacena el hash de la contraseña, nunca la contraseña original. El campo `role` permite diferenciar entre usuarios registrados y administradores sin necesidad de crear una tabla adicional para los roles.

El nombre de usuario no podrá modificarse una vez creada la cuenta. Esta condición se controlará desde la lógica de la aplicación.

### 3.2. Tabla `books`

Almacena el catálogo de libros disponible en Libroverso.

**Justificación:**

Esta tabla almacena los datos generales de cada libro, independientemente de los usuarios que lo tengan en su biblioteca.

La información del libro se guarda una sola vez. De esta manera, no es necesario repetir el título, autor o número total de páginas en cada biblioteca personal.

El número total de páginas deberá ser mayor que cero.

### 3.3. Tabla `user_books`

Es la tabla intermedia que relaciona a los usuarios con los libros de su biblioteca personal. Resuelve la relación muchos a muchos (M:N) entre `users` y `books`.

**Restricciones adicionales:**

- La combinación `user_id` y `book_id` será única para evitar que un usuario añada varias veces el mismo libro.
- `user_id` referencia a `users.id`.
- `book_id` referencia a `books.id`.

**Justificación:**

Esta tabla permite que cada usuario tenga su propia biblioteca personal y registre el estado de lectura de cada libro.

Es una relación muchos a muchos porque un usuario puede tener varios libros y un mismo libro puede estar presente en las bibliotecas de distintos usuarios.

Además, contiene atributos propios de esa relación, como la fecha de inicio, el estado de lectura y la fecha de finalización.

El progreso de páginas se calculará a partir de las sesiones de lectura asociadas a cada registro de esta tabla, evitando almacenar información duplicada.

### 3.4. Tabla `reading_sessions`

Almacena las sesiones de lectura realizadas por los usuarios.

**Justificación:**

Esta tabla permite conservar un historial de las sesiones de lectura de cada usuario.

Cada sesión está asociada a un registro de `user_books`, lo que permite conocer qué usuario ha leído, qué libro y cuántas páginas ha avanzado.

El progreso total de un libro se obtiene sumando las páginas registradas en sus sesiones de lectura.

El campo `pages_read` deberá ser mayor que cero y la aplicación comprobará que el progreso acumulado no supere el número total de páginas del libro.

### 3.5. Tabla `characters`

Almacena los datos del personaje asociado a cada usuario.

**Justificación:**

Cada usuario dispone de un único personaje que representa su progreso dentro de Libroverso.

El personaje almacena el nivel, la experiencia y las monedas obtenidas mediante la actividad lectora.

La relación entre `users` y `characters` es uno a uno (1:1). La restricción UNIQUE sobre `user_id` impide que un mismo usuario tenga varios personajes.

### 3.6. Tabla `cosmetic_items`

Almacena el catálogo de elementos estéticos que pueden adquirirse para personalizar los personajes.

**Justificación:**

Esta tabla contiene el catálogo de elementos estéticos disponibles en la aplicación, como accesorios, ropa o fondos.

El precio se expresa en monedas virtuales y permitirá gestionar las adquisiciones mediante la economía interna del juego.

La categoría permitirá clasificar los elementos para facilitar su selección y personalización.

### 3.7. Tabla `inventory_items`

Relaciona los personajes con los elementos estéticos que han adquirido.

**Restricciones adicionales:**

- La combinación `character_id` y `cosmetic_item_id` será única para evitar adquisiciones duplicadas del mismo elemento.
- `character_id` referencia a `characters.id`.
- `cosmetic_item_id` referencia a `cosmetic_items.id`.

**Justificación:**

Esta tabla representa el inventario de cada personaje y permite registrar los elementos estéticos que ha adquirido.

Resuelve una relación muchos a muchos (M:N) entre personajes y elementos estéticos: un personaje puede poseer varios elementos y un mismo elemento puede estar presente en los inventarios de distintos personajes.

Incluye atributos propios de la relación, como la fecha de adquisición y si el elemento está equipado.

## 4. Resumen de relaciones y cardinalidades

Las relaciones muchos a muchos se resuelven mediante tablas intermedias:

- `users` y `books` mediante `user_books`.
- `characters` y `cosmetic_items` mediante `inventory_items`.

Ambas tablas intermedias contienen atributos propios de las relaciones que representan.

## 5. Justificación de la normalización hasta 3FN

El modelo se ha diseñado siguiendo las reglas de normalización:

**Primera Forma Normal (1FN)**

Todas las tablas tienen una clave primaria y cada campo almacena un único valor. No se utilizan listas de valores ni grupos de columnas repetidos.

**Segunda Forma Normal (2FN)**

Todos los atributos dependen de la clave primaria completa de su tabla. Las relaciones muchos a muchos se resuelven mediante tablas intermedias, evitando dependencias parciales.

**Tercera Forma Normal (3FN)**

Los atributos de cada tabla dependen de su clave primaria y no de otros atributos no clave.

Los datos generales de los libros se almacenan en `books`, mientras que los datos particulares de la relación entre usuario y libro se almacenan en `user_books`.

Las sesiones de lectura se almacenan de forma independiente en `reading_sessions`, evitando repetir información de los libros y usuarios.

El progreso total de lectura se calcula a partir de las sesiones registradas, evitando duplicar el número de páginas leídas en distintas tablas.

El nivel, la experiencia y las monedas pertenecen al personaje, mientras que los datos del catálogo estético se mantienen separados de los registros del inventario.

## 6. Restricciones e integridad de los datos

Se establecen las siguientes reglas para mantener la coherencia de la base de datos:

- Los nombres de usuario deben ser únicos y obligatorios.
- Las contraseñas deben almacenarse mediante un hash seguro.
- El rol de usuario solo podrá tomar los valores `user` o `admin`.
- El número total de páginas de un libro debe ser positivo.
- Un usuario no podrá añadir dos veces el mismo libro a su biblioteca.
- Las páginas registradas en una sesión deben ser mayores que cero.
- El progreso acumulado no podrá superar el total de páginas del libro.
- Cada usuario tendrá un único personaje.
- El nivel inicial de un personaje será 1.
- La experiencia y las monedas no podrán ser negativas.
- El precio de los elementos estéticos no podrá ser negativo.
- Un personaje no podrá adquirir dos veces el mismo elemento.
- La adquisición de elementos deberá comprobar que el personaje dispone de monedas suficientes.

Las restricciones que no puedan garantizarse únicamente mediante claves, índices o restricciones de la base de datos se validan desde la lógica de la aplicación.

## 7. Consideraciones finales

Este modelo constituye la estructura lógica inicial de la base de datos de Libroverso.

La creación física de las tablas se realizan mediante migraciones del ORM, respetando las claves primarias, claves foráneas, restricciones y relaciones definidas en este documento.

La carga de datos de prueba se realizan mediante seeders, incluyendo usuarios con diferentes roles y un catálogo inicial de libros y elementos estéticos.
