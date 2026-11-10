# TPI - Entornos Gráficos (redeploy 2026)

**Módulo:** gestión de consultas docentes (UTN FRRO).

## Correr sin XAMPP (Docker)

```bash
cp ModuloAvisoDeConsultas/config/db.config.docker.php ModuloAvisoDeConsultas/config/db.config.php
docker compose up --build
```

→ **http://localhost:8080/index.php** (detalle en [`database/README.md`](database/README.md))

## Correr con XAMPP

Ver [`database/README.md`](database/README.md) opción B.

## Demo

| Rol | Acceso |
|-----|--------|
| Docente | `rdario@gmail.com` / `111111` |
| Alumno | `rdario@gmail.com` (solo email) |
| Admin | `admin@utn.edu.ar` / `admin111` |
