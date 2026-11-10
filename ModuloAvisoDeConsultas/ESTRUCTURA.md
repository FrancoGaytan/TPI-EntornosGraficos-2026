# Estructura del módulo

Las **páginas públicas** siguen en la raíz del módulo para que las URLs no cambien (`index.php`, `loginDocente.php`, etc.).

```
ModuloAvisoDeConsultas/
├── acciones/          # POST/GET: login, CRUD, inscripciones, mail
├── config/            # db.php + db.config.* (local, no commitear .php real)
├── includes/          # sesión, restricciones por rol, consultas a BD
├── lib/PHPMailer/     # envío de correo (contacto)
├── templates/         # header.php, footer.php
├── css/, img/         # estáticos
├── scripts/           # utilidades de mantenimiento (refactor_paths.py)
└── *.php              # vistas y pantallas (requieren includes/bootstrap.php)
```

## Rutas en PHP

- `includes/bootstrap.php` define `APP_ROOT`, `app_path()` y `require_app()`.
- Desde la raíz del módulo: `require_once __DIR__ . '/includes/bootstrap.php'`.
- Desde `acciones/`: `require_once __DIR__ . '/../includes/bootstrap.php'`.
- Includes internos: `require_app('config/db.php')`, `require_app('templates/header.php')`, etc.
- Formularios y enlaces hacia acciones: `./acciones/nombre.php`.
- Redirecciones desde `acciones/`: `../listadoConsultas.php`, `../misConsultasDoc.php`, etc.

## Base de datos y Docker

Ver [`../database/README.md`](../database/README.md).
