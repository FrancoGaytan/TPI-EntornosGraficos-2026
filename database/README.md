# Base de datos — TPI Consultas UTN

## Opción A — Docker (sin XAMPP)

Requisito: [Docker Desktop](https://www.docker.com/products/docker-desktop/) en ejecución.

Desde la raíz del repo (`TPIEntornosGraficos`):

```bash
cp ModuloAvisoDeConsultas/config/db.config.docker.php ModuloAvisoDeConsultas/config/db.config.php
docker compose up --build
```

Abrí: **http://localhost:8080/index.php**

La primera vez, MariaDB importa solo `schema.sql` y `seed_demo.sql`. Para **reiniciar la base desde cero**:

```bash
docker compose down -v
docker compose up --build
```

(`-v` borra el volumen de datos.)

### Credenciales demo (después del seed)

| Rol | Cómo entrar |
|-----|-------------|
| **Docente** | `loginDocente.php` → `rdario@gmail.com` / `111111` |
| **Alumno** | `loginAlumno.php` → `rdario@gmail.com` |
| **Admin** | `loginAdmin.php` → `admin@utn.edu.ar` / `admin111` |

---

## Opción B — XAMPP (clásico en la cátedra)

1. Instalá [XAMPP](https://www.apachefriends.org/) (Apache + MySQL + PHP).
2. Copiá `ModuloAvisoDeConsultas` a `C:\xampp\htdocs\`.
3. phpMyAdmin → importar `schema.sql` y `seed_demo.sql`.
4. `cp ModuloAvisoDeConsultas/config/db.config.example.php ModuloAvisoDeConsultas/config/db.config.php`
5. `http://localhost/ModuloAvisoDeConsultas/index.php`

---

## Imágenes

Faltan en Git: `img/logo2.png`, `img/logo.png`, `img/perfilVacio.jpg`. Agregá logos o placeholders para la demo.

## Hosting remoto

Importá SQL en el panel del proveedor y configurá `db.config.php` con sus credenciales (no subir a Git; está en `.gitignore`).
