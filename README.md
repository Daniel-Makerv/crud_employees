# CRUD Employees

Aplicación desarrollada con Laravel, Vue 3, Inertia.js, Tailwind CSS y MySQL.

## Requisitos

Antes de instalar el proyecto asegúrate de tener:

- PHP 8.4+
- Composer
- Node.js 24+
- NPM
- MySQL
- Git

Puedes comprobar las versiones instaladas con:

```bash
php -v
composer --version
node -v
npm -v
mysql --version
git --version
```

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone URL_DEL_REPOSITORIO
```

Entrar al proyecto:

```bash
cd crud-employees
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de JavaScript

```bash
npm install
```

### 4. Crear el archivo de configuración

Copiar `.env.example`:

```bash
cp .env.example .env
```

En Windows CMD:

```cmd
copy .env.example .env
```

### 5. Generar la llave de Laravel

```bash
php artisan key:generate
```

### 6. Configurar la base de datos

Crear una base de datos MySQL.

Por ejemplo:

```sql
CREATE DATABASE crud_employees;
```

Después configurar las siguientes variables en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_employees
DB_USERNAME=root
DB_PASSWORD=
```

Modificar `DB_USERNAME` y `DB_PASSWORD` de acuerdo con la configuración local de MySQL.

### 7. Ejecutar migraciones

```bash
php artisan migrate
```

Si el proyecto contiene seeders y se quieren cargar los datos iniciales:

```bash
php artisan db:seed
```

También se pueden ejecutar migraciones y seeders al mismo tiempo:

```bash
php artisan migrate --seed
```

---

## Ejecutar el proyecto

Se necesitan dos terminales.

### Terminal 1 - Laravel

```bash
php artisan serve
```

Por defecto la aplicación estará disponible en:

```text
http://127.0.0.1:8000
```

### Terminal 2 - Vite

```bash
npm run dev
```

Mantener ambos procesos ejecutándose durante el desarrollo.

---

## Compilar frontend

Para generar los archivos del frontend para producción:

```bash
npm run build
```

---

## Reiniciar la base de datos

Para eliminar todas las tablas y ejecutar nuevamente las migraciones:

```bash
php artisan migrate:fresh
```

Con seeders:

```bash
php artisan migrate:fresh --seed
```

> Este comando elimina todos los datos existentes de la base de datos.

---

## Limpiar caché

Si se realizan cambios de configuración, rutas o variables de entorno:

```bash
php artisan optimize:clear
```

---

## Comandos rápidos

Para una instalación nueva:

```bash
git clone URL_DEL_REPOSITORIO
cd crud-employees

composer install
npm install

cp .env.example .env

php artisan key:generate
```

Configurar la base de datos en `.env` y después ejecutar:

```bash
php artisan migrate --seed
npm run dev
```

En otra terminal:

```bash
php artisan serve
```

---

## Stack

- Laravel
- PHP
- Vue 3
- Inertia.js
- Tailwind CSS
- Vite
- MySQL
- Laravel Breeze
- Laravel Excel

---

## Estructura principal

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
├── Exports/
└── Imports/

database/
├── migrations/
├── factories/
└── seeders/

resources/
└── js/
    ├── Components/
    ├── Layouts/
    └── Pages/

routes/
└── web.php
```

---

## Funcionalidades

El proyecto incluye:

- Autenticación
- Roles
- Permisos
- Protección de rutas mediante permisos
- CRUD de productos
- Paginación
- Importación de productos desde Excel
- Exportación de productos a Excel
- Descarga de plantilla para importación
- Vue 3 + Inertia.js
- Interfaz con Tailwind CSS

---

## Permisos

El sistema utiliza roles y permisos.

Los usuarios pertenecen a un rol y los roles tienen permisos asociados.

Ejemplos de permisos:

```text
view-products
create-products
edit-products
delete-products
export-products
import-products
```

Las rutas del backend están protegidas mediante middleware:

```php
->middleware('permission:view-products')
```

Además, el frontend utiliza los permisos del usuario para mostrar u ocultar las acciones correspondientes.

---

## Problemas comunes

### Error de APP_KEY

Si aparece:

```text
No application encryption key has been specified.
```

Ejecutar:

```bash
php artisan key:generate
```

### Error de conexión a MySQL

Verificar las variables:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_employees
DB_USERNAME=root
DB_PASSWORD=
```

Después:

```bash
php artisan optimize:clear
```

### Cambios de frontend no visibles

Verificar que Vite esté ejecutándose:

```bash
npm run dev
```

### Error después de modificar rutas o configuración

Ejecutar:

```bash
php artisan optimize:clear
```

---

## Producción

Antes de desplegar el proyecto:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan optimize
```

Las migraciones en producción deben ejecutarse con:

```bash
php artisan migrate --force
```

Configurar:

```env
APP_ENV=production
APP_DEBUG=false
```

Nunca subir el archivo `.env` al repositorio.
