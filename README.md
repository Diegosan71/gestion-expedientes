# Gestión de Expedientes

Aplicación web desarrollada con **Laravel 10** y **Bootstrap 5** para gestionar expedientes, con roles de usuario y administrador.

---

## **Requisitos**

- PHP 8.2+
- Composer
- PostgreSQL
- Node.js + npm (para assets de frontend)
- Git

---

## **Instalación del proyecto**

1. Clonar el repositorio:

```bash
git clone https://github.com/Diegosan71/gestion-expedientes.git
cd expedientes-app
Instalar dependencias de PHP:

bash
Copiar código
composer install
Instalar dependencias de frontend:

bash
Copiar código
npm install
npm run dev
Copiar el archivo de configuración .env:

bash
Copiar código
cp .env.example .env
Configurar la base de datos en .env (PostgreSQL):

env
Copiar código
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nombre_de_tu_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
Ejecutar migraciones y seeders:

bash
Copiar código
php artisan migrate --seed
Esto crea las tablas, roles, estatus y usuarios precargados.

Usuarios precargados
Rol	Email	Contraseña
Administrador	admin@example.com	admin123
Usuario	user@example.com	user123



Ejecutar la aplicación
Levantar el servidor de Laravel:

bash
Copiar código
php artisan serve
Abrir en el navegador:

cpp
Copiar código
http://127.0.0.1:8000
Iniciar sesión con los usuarios precargados según tu rol.

Funcionalidades
Roles: Administrador y Usuario normal

CRUD de expedientes con soft delete

Filtros por estatus, rango de fechas y búsqueda

Políticas de acceso usando ExpedientePolicy

Interfaz clara con Bootstrap 5