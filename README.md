

## Requisitos

Antes de comenzar, asegúrate de tener las siguientes herramientas instaladas:

- **PHP** 8.3 o superior
- **Composer** para gestionar dependencias PHP
- **SQLite** o MySQL (dependiendo de tu configuración)
- **Node.js** y **npm** para la construcción del front-end (si es necesario)

## Instalación

### 1. Clonar el repositorio

Clona el repositorio a tu máquina local:

```bash
git clone https://github.com/Al88/fisio_sesion_test
```

### 2. Instalar dependencias

Instala las dependencias de PHP utilizando Composer:

```bash
composer install
```

Luego, instala las dependencias de JavaScript

```bash
npm install
```

### 3. Configuración del entorno

Copia el archivo `.env.example` a `.env`:

```bash
cp .env.example .env
```

Configura tu base de datos en el archivo `.env`:

- Para usar **SQLite** (recomendado para pruebas):

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

- Para usar **MySQL**:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shortener
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Crear la base de datos

Si usas SQLite, asegúrate de que el archivo `database/database.sqlite` exista:

```bash
touch database/database.sqlite
```

Si usas MySQL, asegúrate de crear la base de datos que configuraste en `.env`.

### 5. Ejecutar migraciones

Ejecuta las migraciones para crear las tablas necesarias en la base de datos:

```bash
php artisan migrate
```

### 6. Ejecutar el servidor

Puedes ejecutar el servidor de desarrollo de Laravel con el siguiente comando:

```bash
php artisan serve
```

Esto iniciará el servidor en `http://localhost:8000`.

## FRONTEND

### 1. Instalar las dependencias del frontend

```bash
npm install
```

### 2. Ejecutar el frontend


```bash
npm run dev
```

## Licencia

Este proyecto está bajo la Licencia MIT. Para más detalles, consulta el archivo [LICENSE](LICENSE).
