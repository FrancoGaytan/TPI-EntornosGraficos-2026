# Consultas UTN

Sitio para que un docente publique el día y el horario de una consulta, y el alumno se anote si queda lugar. Es el trabajo de Entornos Gráficos, UTN Facultad Regional Rosario.

## Cómo levantarlo

Hace falta Docker Desktop, abierto.

En esta carpeta:

```
copy ModuloAvisoDeConsultas\config\db.config.docker.php ModuloAvisoDeConsultas\config\db.config.php
docker compose up --build
```

En Mac o Linux, el primer comando es `cp` en lugar de `copy`.

Cuando termina, entrar a http://localhost:8080/

La base se crea sola la primera vez.

Si se usa XAMPP en lugar de Docker, copiar `db.config.example.php` como `db.config.php` dentro de `ModuloAvisoDeConsultas/config`, importar `database/schema.sql` y después `database/seed_demo.sql`, y abrir el módulo desde htdocs.

## Usuarios para probar

Docente: `rdario@gmail.com` / `111111`

Alumno: legajo `45791` y mail `gaytanfranco@gmail.com`. Después pide un código. Si el correo no está configurado, el código aparece en la pantalla.

Administrador: `admin@utn.edu.ar` / `admin111`, en `loginAdmin.php`

Los demás docentes usan un mail `apellido.nombre@demo.frro.utn.edu.ar` y la misma clave `111111`.
