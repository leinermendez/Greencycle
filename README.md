# GreenCycle 

Aplicación web para plantar, cuidar y hacer crecer árboles virtuales. Los usuarios registran una cuenta, siembran semillas que comienzan como brotes y, con cuidados constantes, revelan su especie y maduran hasta poder ser cosechadas. Este repositorio corresponde a la entrega del **Sprint 1**.

## Alcance actual (Sprint 1)

En este sprint la aplicación permite:

- Registro e inicio de sesión de usuarios (autenticación con Laravel Sanctum).
- Cierre de sesión invalidando el token activo.
- Consultar el listado de árboles propios (`GET /api/trees`).
- Consultar el detalle de un árbol propio (`GET /api/trees/{tree}`).
- Plantar un árbol / sembrar una semilla (`POST /api/trees`), quedando como brote (`species_id` nulo, `level = 0`).
- Modelo de datos inicial (`users`, `species_catalog`, `items_catalog`, `user_items`, `trees`) con las relaciones y campos base para soportar catálogo, inventario y crecimiento.

Quedan deliberadamente para sprints posteriores: la economía interna (monedas verdes), la lógica avanzada de inventario y consumo de ítems, los contadores/reglas temporales de cuidado (riego automático, acelerador) y la revelación aleatoria de especie al madurar.

## Stack / requisitos

- PHP >= 8.1
- Composer
- Node.js / npm (para el frontend)
- Base de datos MySQL (u otra compatible configurada en `.env`)
- Laravel Sanctum (autenticación por token)

## Instalación

```bash
# Clonar el repositorio
git clone https://github.com/leinermendez/Greencycle.git
cd Greencycle

# Instalar dependencias de backend
composer install

# Copiar variables de entorno
cp .env.example .env
php artisan key:generate

# Instalar dependencias de frontend
npm install

# Ejecutar migraciones y seeders
php artisan migrate --seed
```

## Configuración

Variables necesarias en `.env` (sin secretos reales — ver `.env.example`):

```
APP_NAME=GreenCycle
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=greencycle
DB_USERNAME=
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost
SESSION_DOMAIN=localhost
```

## Ejecución

```bash
# Levantar el backend
php artisan serve

# Compilar/observar el frontend (en otra terminal)
npm run dev
```

La aplicación queda disponible en `http://localhost:8000`.

## Pruebas / verificación

```bash
php artisan test
```

Verificación manual sugerida: registrar un usuario, iniciar sesión, plantar un árbol y confirmar que aparece en el listado (`GET /api/trees`) y en el detalle (`GET /api/trees/{tree}`).

## API

Endpoints del Sprint 1:

| Método | Ruta | Propósito |
|---|---|---|
| POST | `/api/register` | Registrar un usuario nuevo |
| POST | `/api/login` | Iniciar sesión y obtener token |
| POST | `/api/logout` | Cerrar sesión (invalida el token) |
| GET | `/api/trees` | Listar árboles del usuario autenticado |
| GET | `/api/trees/{tree}` | Consultar el detalle de un árbol propio |
| POST | `/api/trees` | Plantar un árbol (sembrar una semilla) |

Todos los endpoints de árboles requieren autenticación mediante token Sanctum (`Authorization: Bearer {token}`).

## Credenciales demo

_No se incluyen credenciales personales. Si se requiere una cuenta de prueba, crearla localmente mediante `POST /api/register` con datos ficticios._

## Equipo y atribuciones

- Leiner Méndez Jiménez
- Roberto Mora Aviles
- Anyeli Carranza Retana

Rama principal: `develop`. Ramas de trabajo del sprint: `feature/auth-system`, `feature/catalog-and-models`, `feature/trees-api`, `feature/frontend-ui`, `bugfix/inventory-relation-fix`.
