## 1 Diccionario de datos

### 1.1. Tabla `users`

| Campo | Tipo de dato | Restricciones | Descripción |

- | id | BIGINT | PK, autoincremental | Identificador único del usuario. |
- | name | VARCHAR(100) | NOT NULL, UNIQUE | Nombre de usuario, único y no modificable. |
- | email | VARCHAR(255) | NOT NULL, UNIQUE | Correo electrónico asociado a la cuenta. |
- | password | VARCHAR(255) | NOT NULL | Contraseña almacenada mediante un hash seguro. |
- | role | VARCHAR(20) | NOT NULL, DEFAULT 'user' | Rol del usuario: user o admin. |
- | created_at | TIMESTAMP | NULL | Fecha de creación del registro. |
- | updated_at | TIMESTAMP | NULL | Fecha de última modificación. |

### 1.2. Tabla `books`

| Campo | Tipo de dato | Restricciones | Descripción |

- | id | BIGINT | PK, autoincremental | Identificador único del libro. |
- | title | VARCHAR(200) | NOT NULL | Título del libro. |
- | author | VARCHAR(150) | NOT NULL | Autor del libro. |
- | total_pages | INT | NOT NULL | Número total de páginas. |
- | created_at | TIMESTAMP | NULL | Fecha de creación del registro. |
- | updated_at | TIMESTAMP | NULL | Fecha de última modificación. |

### 1.3. Tabla `user_books`

| Campo | Tipo de dato | Restricciones | Descripción |

- | id | BIGINT | PK, autoincremental | Identificador del registro. |
- | user_id | BIGINT | FK, NOT NULL | Usuario propietario del libro. |
- | book_id | BIGINT | FK, NOT NULL | Libro añadido a la biblioteca. |
- | started_at | DATE | NULL | Fecha en la que comenzó a leerlo. |
- | status | VARCHAR(20) | NOT NULL, DEFAULT 'reading' | Estado del libro: reading, paused o completed. |
- | completed_at | DATE | NULL | Fecha en la que terminó el libro. |
- | created_at | TIMESTAMP | NULL | Fecha de creación del registro. |
- | updated_at | TIMESTAMP | NULL | Fecha de última modificación. |

### 1.4. Tabla `reading_sessions`

| Campo | Tipo de dato | Restricciones | Descripción |

- | id | BIGINT | PK, autoincremental | Identificador único de la sesión. |
- | user_book_id | BIGINT | FK, NOT NULL | Referencia al libro de la biblioteca personal. |
- | pages_read | INT | NOT NULL | Número de páginas leídas durante la sesión. |
- | read_at | DATETIME | NOT NULL | Fecha y hora de la sesión. |
- | created_at | TIMESTAMP | NULL | Fecha de creación del registro. |
- | updated_at | TIMESTAMP | NULL | Fecha de última modificación. |

### 1.5. Tabla `characters`

| Campo | Tipo de dato | Restricciones | Descripción |

- | id | BIGINT | PK, autoincremental | Identificador único del personaje. |
- | user_id | BIGINT | FK, NOT NULL, UNIQUE | Usuario propietario del personaje. |
- | level | INT | NOT NULL, DEFAULT 1 | Nivel actual del personaje. |
- | experience | INT | NOT NULL, DEFAULT 0 | Experiencia acumulada. |
- | coins | INT | NOT NULL, DEFAULT 0 | Monedas virtuales disponibles. |
- | created_at | TIMESTAMP | NULL | Fecha de creación del registro. |
- | updated_at | TIMESTAMP | NULL | Fecha de última modificación. |

### 1.6. Tabla `cosmetic_items`

| Campo | Tipo de dato | Restricciones | Descripción |

- | id | BIGINT | PK, autoincremental | Identificador único del elemento. |
- | name | VARCHAR(100) | NOT NULL | Nombre del elemento estético. |
- | description | VARCHAR(255) | NULL | Descripción del elemento. |
- | category | VARCHAR(50) | NOT NULL | Categoría del elemento. |
- | price | INT | NOT NULL | Precio expresado en monedas virtuales. |
- | created_at | TIMESTAMP | NULL | Fecha de creación del registro. |
- | updated_at | TIMESTAMP | NULL | Fecha de última modificación. |

### 1.7. Tabla `inventory_items`

| Campo | Tipo de dato | Restricciones | Descripción |

- | id | BIGINT | PK, autoincremental | Identificador del registro del inventario. |
- | character_id | BIGINT | FK, NOT NULL | Personaje propietario del elemento. |
- | cosmetic_item_id | BIGINT | FK, NOT NULL | Elemento estético adquirido. |
- | acquired_at | DATETIME | NOT NULL | Fecha de adquisición. |
- | is_equipped | BOOLEAN | NOT NULL, DEFAULT FALSE | Indica si el elemento está equipado. |
- | created_at | TIMESTAMP | NULL | Fecha de creación del registro. |
- | updated_at | TIMESTAMP | NULL | Fecha de última modificación. |
