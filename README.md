
# Challenge

Este proyecto fue diseñado pensando en la **escalabilidad** y **robustez** que ofrece Laravel, con el objetivo de crear una base sólida para desarrollar APIs que puedan crecer fácilmente y soportar un alto volumen de tráfico. La integración con **L5-Swagger** proporciona documentación automática para la API, lo que facilita el mantenimiento y la colaboración dentro de equipos de desarrollo.

Laravel fue elegido como el **framework** principal debido a su capacidad para permitir un desarrollo ágil y rápido, asegurando que nuevas funcionalidades puedan ser agregadas con facilidad. Además, su arquitectura modular y flexible permite integrar fácilmente nuevas características, como autenticación, gestión de permisos y más.

## Características principales:

- **Escalable**: Estructura diseñada para crecer sin comprometer el rendimiento.
- **Robusto**: Basado en Laravel, asegurando un alto nivel de seguridad y consistencia.
- **Documentación automática**: Generada con L5-Swagger, permitiendo que la API siempre esté documentada.
- **Fácil integración de lógica de autenticación**: Laravel permite integrar paquetes como Passport o Sanctum para gestionar autenticación y permisos sin fricción.

---

## Requisitos

### Variables de entorno obligatorias:

Debes crear un archivo `.env` en la raíz del proyecto con las siguientes variables de entorno:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:98QIVPbFOm+WLCcMy6GQhBfTj7cf41cBmsOVRRTg3VM=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=password

AUTH_GUARD=api

L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_API_VERSION=1.0.0
L5_SWAGGER_API_BASE_PATH=/api
L5_SWAGGER_TITLE="API Documentation"
```

### Variables clave:

- `APP_KEY`: Necesaria para el cifrado de datos en Laravel.
- `DB_*`: Configuración de la base de datos PostgreSQL.
- `L5_SWAGGER_*`: Variables para generar automáticamente la documentación de Swagger.

---

## Correr el proyecto con Docker

### Requisitos:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

### Pasos para ejecutar con Docker:

1. Clona el repositorio y navega a la carpeta del proyecto.

2. Asegúrate de tener un archivo `.env` configurado en la raíz del proyecto.

3. Construye y corre los contenedores usando Docker Compose:

   ```bash
   docker-compose up -d
   ```

4. Ejecuta las migraciones para la base de datos:

   ```bash
   docker-compose exec app php artisan migrate
   ```

5. Accede a la aplicación en tu navegador:

   ```
   http://localhost:8000
   ```

6. Accede a la documentación de Swagger:

   ```
   http://localhost:8000/api/documentation
   ```

## Correr el proyecto sin Docker

### Requisitos:

- [PHP 8.x](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [PostgreSQL](https://www.postgresql.org/download/)
- [Node.js](https://nodejs.org/)

### Pasos para ejecutar sin Docker:

1. Clona el repositorio y navega a la carpeta del proyecto.

2. Asegúrate de tener un archivo `.env` configurado en la raíz del proyecto.

3. Instala las dependencias de PHP:

   ```bash
   composer install
   ```

5. Genera la clave de la aplicación (si no está configurada):

   ```bash
   php artisan key:generate
   ```

6. Crea la base de datos PostgreSQL y asegúrate de que los valores de `DB_*` en el archivo `.env` sean correctos.

7. Ejecuta las migraciones para crear las tablas:

   ```bash
   php artisan migrate
   ```

8. Inicia el servidor de desarrollo de Laravel:

   ```bash
   php artisan serve
   ```

9. Accede a la aplicación en tu navegador:

   ```
   http://localhost:8000
   ```

10. Accede a la documentación de Swagger:

    ```
    http://localhost:8000/api/documentation
    ```

---

## Documentación de la API

La documentación de la API está disponible a través de Swagger y se genera automáticamente en base a las anotaciones en los controladores.

- URL de la documentación Swagger:

  ```
  http://localhost/api/documentation
  ```

Para regenerar la documentación, ejecuta el siguiente comando:

```bash
php artisan l5-swagger:generate
```

---

## Autenticación

Este proyecto fue diseñado para que la lógica de autenticación pueda ser fácilmente integrada. Laravel ofrece varias opciones, incluyendo **Laravel Passport** o **Laravel Sanctum**. Con estos paquetes, puedes agregar autenticación basada en tokens para proteger tus endpoints con facilidad.

Ejemplo de integración:

- **Laravel Sanctum**: Proporciona autenticación de API simple y ligera.
- **Laravel Passport**: Implementa OAuth2 para gestionar permisos más avanzados.

Para agregar autenticación, simplemente instala el paquete deseado y configura el guard de autenticación en el archivo `.env`:

```env
AUTH_GUARD=api
```

Con esta configuración, puedes proteger tus rutas agregando middleware como `auth:api`.

---

## Comandos útiles

- **Correr migraciones**:

  ```bash
  php artisan migrate
  ```

- **Regenerar la documentación Swagger**:

  ```bash
  php artisan l5-swagger:generate
  ```

- **Ver el log de Docker**:

  ```bash
  docker-compose logs -f
  ```

---

