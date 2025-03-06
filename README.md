# 👥 User Profile Manager

## 📝 Descripción

Una plataforma moderna para la gestión de perfiles profesionales construida con Laravel y Tailwind CSS. El proyecto permite a los usuarios gestionar su información personal, experiencia laboral y habilidades de manera organizada y atractiva.

## 📸 Capturas de Pantalla

### 📊 Dashboard

![Dashboard](/screenshots/dashboard.png)
_Panel principal con resumen de información del usuario_

### 💼 Experiencias Laborales

![Experiencias](/screenshots/experiencias.png)
_Gestión de experiencias laborales con línea de tiempo_

### 🌟 Habilidades

![Habilidades](/screenshots/habilidades.png)
_Sistema de gestión de habilidades con niveles de competencia_

### 👥 Gestión de Usuarios

![Usuarios](/screenshots/usuarios.png)
_Panel de administración de usuarios (solo admin)_

### ➕ Creación de Usuarios

![Crear Usuario](/screenshots/crear-usuario.png)
_Formulario para la creación de nuevos usuarios_

### 💼 Añadir Experiencia

![Crear Experiencia](/screenshots/crear-experiencia.png)
_Interfaz para agregar nuevas experiencias laborales_

### 🎯 Agregar Habilidades

![Crear Habilidad](/screenshots/crear-habilidad.png)
_Formulario para registrar nuevas habilidades_

## 🚀 Tecnologías Utilizadas

### Frontend

-   🎨 Tailwind CSS para diseño responsive
-   🔄 Alpine.js para interactividad
-   📱 Diseño mobile-first
-   🎭 Font Awesome para iconografía

### Backend

-   ⚡ Laravel 10
-   🗃️ SQLite como base de datos
-   🔐 Sistema de autenticación Breeze
-   📝 Blade para plantillas
-   🔄 Eloquent ORM

## 🛠️ Requisitos Previos

-   PHP 8.2 o superior
-   Composer
-   Node.js y npm
-   SQLite

## ⚙️ Configuración del Proyecto

1. **Clonar el repositorio**

```bash
git clone <url-del-repositorio>
cd User_Profile_Manager
```

2. **Instalar dependencias de PHP**

```bash
composer install
```

3. **Instalar dependencias de Node.js**

```bash
npm install
```

4. **Configurar el entorno**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar la base de datos**

-   Asegúrate de que el archivo database.sqlite existe en la carpeta database

```bash
touch database/database.sqlite
```

6. **Ejecutar migraciones y seeders**

```bash
php artisan migrate:fresh --seed
```

## 🚀 Iniciar el Proyecto

1. **Iniciar el servidor de desarrollo de Laravel**

```bash
php artisan serve
```

2. **Iniciar Vite para el frontend**

```bash
npm run dev
```

## 📊 Características Principales

-   👤 Gestión de perfiles de usuario
-   💼 Sistema de experiencias laborales
-   🌟 Sistema de habilidades con niveles
-   📊 Dashboard interactivo
-   🔐 Control de acceso basado en roles
-   📱 Diseño totalmente responsive
-   🎨 Interfaz moderna y atractiva

## 🗂️ Estructura del Proyecto

```
User_Profile_Manager/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Policies/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── routes/
├── database/
│   ├── migrations/
│   └── seeders/
└── public/
```

## 🔐 Seguridad

-   Autenticación mediante Laravel Breeze
-   Políticas de acceso para recursos
-   Validación de formularios
-   Protección CSRF
-   Encriptación de contraseñas

## 👥 Roles de Usuario

### 👑 Administrador (primer usuario)

-   Gestión completa de usuarios
-   Acceso a todos los perfiles
-   Capacidad de crear y eliminar usuarios

### 👤 Usuario Regular

-   Gestión de su propio perfil
-   Control de sus experiencias laborales
-   Administración de sus habilidades

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.

## 📞 Soporte

Para soporte o preguntas, por favor abre un issue en el repositorio.

---

⌨️ con ❤️ por [Michael Vairo]
