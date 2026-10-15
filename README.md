# Laravel CRUD API

Una API REST para gestión de estudiantes construida con Laravel 13.

## Descripción Técnica

Esta API proporciona endpoints para realizar operaciones CRUD (Create, Read, Update, Delete) sobre estudiantes. Utiliza la arquitectura MVC de Laravel con una capa de servicios para la lógica de negocio.

### Tecnologías

- **Framework**: Laravel 13
- **PHP**: 8.3+
- **Base de datos**: SQLite (local) / MySQL 8.0 (Docker)
- **Autenticación**: Laravel Sanctum
- **Web Server**: Nginx (Docker)

### Estructura del Proyecto

```
app/
├── Http/Controllers/Api/
│   └── StudentController.php  # Controlador de la API
├── Services/
│   └── StudentService.php      # Lógica de negocio
└── Models/
    └── Student.php            # Modelo Eloquent
routes/
└── api.php                    # Rutas de la API
```

### Endpoints de la API

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/students` | Listar todos los estudiantes |
| GET | `/api/students/{id}` | Obtener un estudiante por ID |
| POST | `/api/students` | Crear un nuevo estudiante |
| PUT | `/api/students/{id}` | Actualizar completamente un estudiante |
| PATCH | `/api/students/{id}` | Actualizar parcialmente un estudiante |
| DELETE | `/api/students/{id}` | Eliminar un estudiante |

### Validación

**Crear Estudiante (POST)**
- `name`: required, string, max:255
- `email`: required, email, unique
- `phone`: required, string, max:20
- `language`: required, string, max:10

**Actualizar Estudiante (PUT)**
- Todos los campos requeridos (excepto que email ignora el registro actual)

**Actualizar Parcialmente (PATCH)**
- Todos los campos opcionales (sometimes)

### Códigos de Respuesta

- `200`: OK
- `201`: Creado
- `204`: Sin contenido (eliminación exitosa)
- `404`: No encontrado (estudiante no existe)
- `422`: Error de validación

## Comandos Fundamentales de Laravel

### Crear un Nuevo Proyecto

```bash
composer create-project laravel/laravel nombre-del-proyecto
cd nombre-del-proyecto
```

### Configuración Inicial

```bash
# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Instalar API scaffolding (Laravel Sanctum)
php artisan install:api
```

### Desarrollo

```bash
# Iniciar servidor de desarrollo
php artisan serve

# Ejecutar migraciones
php artisan migrate

# Revertir migraciones
php artisan migrate:rollback

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Generadores de Código

```bash
# Crear controlador
php artisan make:controller NombreController

# Crear modelo
php artisan make:model NombreModel

# Crear migración
php artisan make:migration crear_tabla

# Crear modelo con migración
php artisan make:model NombreModel -m

# Crear resource controller
php artisan make:controller NombreController --resource
```

### Tinker (Consola Interactiva)

```bash
php artisan tinker
```

### Información

```bash
# Ver rutas
php artisan route:list

# Ver configuración
php artisan config:show nombre-config
```

## Instalación y Ejecución

### Instalación Local (Sin Docker)

1. Clonar el repositorio
2. Instalar dependencias: `composer install`
3. Copiar archivo de entorno: `cp .env.example .env`
4. Generar clave: `php artisan key:generate`
5. Ejecutar migraciones: `php artisan migrate`
6. Iniciar servidor: `php artisan serve`

La API estará disponible en `http://127.0.0.1:8000`

### Instalación con Docker

Este proyecto incluye configuración de Docker Compose para ejecutar la aplicación con MySQL 8.0 y Nginx.

#### Requisitos Previos

- Docker
- Docker Compose

#### Configuración

1. Clonar el repositorio
2. Configurar el archivo `.env` para usar MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

3. Construir e iniciar los contenedores:

```bash
docker-compose up -d --build
```

4. Instalar dependencias dentro del contenedor:

```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

5. Permisos de storage (si es necesario):

```bash
docker-compose exec app chmod -R 755 storage
```

#### Comandos Docker

```bash
# Iniciar contenedores
docker-compose up -d

# Detener contenedores
docker-compose down

# Ver logs
docker-compose logs -f

# Ejecutar comandos en el contenedor de la app
docker-compose exec app php artisan migrate
docker-compose exec app php artisan tinker

# Reiniciar contenedores
docker-compose restart
```

#### Servicios Docker

- **app**: PHP 8.3-FPM con la aplicación Laravel
- **db**: MySQL 8.0
- **nginx**: Nginx como servidor web

La API estará disponible en `http://localhost:8000`

#### Estructura Docker

```
.
├── Dockerfile              # Configuración del contenedor PHP
├── docker-compose.yml      # Orquestación de servicios
├── .dockerignore          # Archivos a ignorar en Docker
└── docker/
    └── nginx/
        └── default.conf   # Configuración de Nginx
```
