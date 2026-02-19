# Cerveceria Tio Mingo

Plataforma web de comercio electrónico orientada a la venta y catálogo de cervezas internacionales. El proyecto permite a los usuarios registrarse, explorar un catálogo de cervezas de todo el mundo, realizar pedidos y gestionar su experiencia de compra, todo ello desde una interfaz moderna construida con Laravel 12.

## Descripción del proyecto

Cerveceria Tio Mingo es una aplicación web desarrollada como proyecto grupal en la que se simula una cervecería que trabaja con distintas marcas internacionales. El objetivo principal es ofrecer al usuario una experiencia completa de compra, desde el registro hasta el pago, incluyendo reseñas, seguimiento de pedidos y localización de proveedores.

## Tecnologías utilizadas

- **Laravel 12** — Framework principal del backend, estructura MVC y lógica de negocio.
- **Blade** — Motor de plantillas nativo de Laravel para la generación de vistas dinámicas.
- **MySQL** — Base de datos relacional para la gestión de entidades y sus relaciones.
- **Laravel Breeze** — Paquete de autenticación para el sistema de registro, login y control de acceso.

## Integraciones con APIs externas

- **PayPal (Sandbox)** — Pasarela de pagos integrada en modo de pruebas para procesar transacciones de forma segura.
- **Google Maps API** — Utilizada para mostrar la ubicación geográfica de los proveedores y cervecerias, cargadas mediante importación CSV, así como para registrar la ubicación del usuario.
- **Telegram Bot API** — Bot de notificaciones que informa al administrador sobre la gestión de cervezas y usuarios desde el panel de administración.
- **Exchange Rate API** — Actualización en tiempo real de tasas de cambio de divisas, integrada en el catálogo de cervezas para mostrar precios en distintas monedas.

## Funcionalidades principales

### Para usuarios registrados

- Registro e inicio de sesión con control de acceso mediante Laravel Breeze.
- Catálogo de cervezas internacionales con las marcas más destacadas de cada país.
- Sistema de compra y venta de cervezas.
- Pasarela de pago integrada con PayPal.
- Gestión y seguimiento de pedidos realizados.
- Sistema de reseñas para valorar productos y experiencias.
- Visualización de la ubicación de proveedores en mapa interactivo.
- Conversión de precios en tiempo real según la divisa del usuario.

### Panel de administración

- CRUD completo para la gestión de cervezas, proveedores, usuarios y locales.
- Notificaciones automáticas vía Telegram Bot ante eventos relevantes.
- Gestión centralizada de pedidos y reseñas.

## Estructura del equipo

El proyecto fue desarrollado de forma colaborativa por cuatro integrantes, cada uno responsable de un área específica:

- **David** — Vistas generales, integración de Google Maps API, configuración de Laravel Breeze y entidades de estilo y cervecería.
- **Javier** — Panel de administración y CRUD, Exchange Rate API, vistas del sistema de login y entidades de usuario y local.
- **Mario** — Vista del catálogo de cervezas, CRUD de administración de cervezas, Telegram Bot API y entidades de cerveza y proveedores.
- **Marcos** — Vistas y gestión de pedidos y reseñas, integración de PayPal con pasarela de pagos y entidades de pedido y reseña.

## Instalación y configuración

### Requisitos previos

- PHP >= 8.2
- Composer
- Node.js y NPM
- MySQL

### Pasos de instalación

1. Clonar el repositorio:

```bash
git clone https://github.com/Javivu748/Cerveceria_tio_mingo.git
cd Cerveceria_tio_mingo/cerveza
```

2. Instalar dependencias de PHP:

```bash
composer install
```

3. Instalar dependencias de Node:

```bash
npm install && npm run build
```

4. Copiar el archivo de entorno y configurarlo:

```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar las variables de entorno en el archivo `.env`, incluyendo la conexión a la base de datos y las claves de las APIs externas (PayPal, Google Maps, Telegram, Exchange Rate).

6. Ejecutar las migraciones y los seeders:

```bash
php artisan migrate --seed
```

7. Iniciar el servidor de desarrollo:

```bash
php artisan serve
```

## Variables de entorno requeridas

Además de la configuración estándar de Laravel, el proyecto requiere las siguientes claves en el archivo `.env`:

```
PAYPAL_CLIENT_ID=
PAYPAL_CLIENT_SECRET=
PAYPAL_MODE=sandbox

GOOGLE_MAPS_API_KEY=

TELEGRAM_BOT_TOKEN=
TELEGRAM_CHAT_ID=

EXCHANGE_RATE_API_KEY=
```

## Licencia

Este proyecto ha sido desarrollado con fines académicos.
