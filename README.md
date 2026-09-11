# CRUD Employees

Proyecto desarrollado con Laravel, Vue 3, Inertia.js, Tailwind CSS y MySQL.

## Requisitos

- PHP 8.4+
- Composer
- Node.js 24+
- MySQL

## Instalación

Instalar dependencias:

```bash
composer install
npm install
```

Crear el archivo `.env`:

```bash
cp .env.example .env
```

Generar la llave de Laravel::

```bash
php artisan key:generate
```

Configurar la conexión a MySQL en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_employees
DB_USERNAME=root
DB_PASSWORD=
```

Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

## Ejecutar el proyecto

Iniciar Laravel:

```bash
php artisan serve
```

En otra terminal iniciar Vite:

```bash
npm run dev
```

La aplicación estará disponible en:

```text
http://127.0.0.1:8000
```

## Reiniciar base de datos

Para recrear completamente la base de datos y ejecutar los seeders:

```bash
php artisan migrate:fresh --seed
```

> Este comando elimina todos los datos existentes.

## Stack

- Laravel 13
- Vue 3
- Inertia.js
- Tailwind CSS
- MySQL
- Laravel Breeze
- Laravel Excel
