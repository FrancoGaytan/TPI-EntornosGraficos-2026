#!/usr/bin/env python3
"""Actualiza includes y URLs tras reorganizar carpetas del TPI."""
from pathlib import Path
import re

ROOT = Path(__file__).resolve().parents[1] / "ModuloAvisoDeConsultas"

SKIP_DIRS = {"lib", ".git"}

ACTION_MAP = {
    "./registrarConsulta.php": "./acciones/registrarConsulta.php",
    "./registrarAlumno.php": "./acciones/registrarAlumno.php",
    "./registrarDocente.php": "./acciones/registrarDocente.php",
    "./validarAdmin.php": "./acciones/validarAdmin.php",
    "./validarAlumno.php": "./acciones/validarAlumno.php",
    "./validarDocente.php": "./acciones/validarDocente.php",
    "./reprogramar.php": "./acciones/reprogramar.php",
    '"enviarFormulario.php"': '"acciones/enviarFormulario.php"',
    "enviarFormulario.php": "acciones/enviarFormulario.php",
    "./cerrarSesion.php": "./acciones/cerrarSesion.php",
    "'./cancelarInscripcion.php'": "'./acciones/cancelarInscripcion.php'",
    "href='deleteAlumno.php": "href='acciones/deleteAlumno.php",
    "href='deleteDocente.php": "href='acciones/deleteDocente.php",
    "href='blockConsulta.php": "href='acciones/blockConsulta.php",
    "href='unblockConsulta.php": "href='acciones/unblockConsulta.php",
    "href='deleteConsulta.php": "href='acciones/deleteConsulta.php",
    "href='inscribirAlumno.php": "href='acciones/inscribirAlumno.php",
}


def patch_content(text: str, rel_from_root: str) -> str:
    in_acciones = rel_from_root.startswith("acciones/")
    in_includes = rel_from_root.startswith("includes/")

    bootstrap = ""
    if rel_from_root.startswith("config/"):
        bootstrap = ""
    elif in_acciones:
        bootstrap = "require_once __DIR__ . '/../includes/bootstrap.php';\n"
    elif in_includes:
        bootstrap = "require_once __DIR__ . '/bootstrap.php';\n"
    else:
        bootstrap = "require_once __DIR__ . '/includes/bootstrap.php';\n"

    if bootstrap and "bootstrap.php" not in text:
        if text.startswith("<?php"):
            rest = text[5:].lstrip("\r\n")
            text = "<?php\n" + bootstrap + rest
        elif text.startswith("<!"):
            text = "<?php\n" + bootstrap + "?>\n" + text

    repl = [
        (r"include_once\s*\(\s*['\"]isSessionStarted\.php['\"]\s*\)", "require_app('includes/isSessionStarted.php')"),
        (r"include_once\s*\(\s*['\"]\.\/isSessionStarted\.php['\"]\s*\)", "require_app('includes/isSessionStarted.php')"),
        (r"include\s*\(\s*['\"]\.\/restringidoAlumno\.php['\"]\s*\)", "require_app('includes/restringidoAlumno.php')"),
        (r"include\s*\(\s*['\"]\.\/restringidoDocente\.php['\"]\s*\)", "require_app('includes/restringidoDocente.php')"),
        (r"include\s*\(\s*['\"]\.\/restringidoAdmin\.php['\"]\s*\)", "require_app('includes/restringidoAdmin.php')"),
        (r"include\s*\(\s*['\"]db\.php['\"]\s*\)", "require_app('config/db.php')"),
        (r"include\s*\(\s*['\"]templates/header\.php['\"]\s*\)", "require_app('templates/header.php')"),
        (r"include\s*\(\s*['\"]templates/footer\.php['\"]\s*\)", "require_app('templates/footer.php')"),
        (r"include\s*\(\s*['\"]\.\/templates/header\.php['\"]\s*\)", "require_app('templates/header.php')"),
        (r"include\s*\(\s*['\"]\.\/templates/footer\.php['\"]\s*\)", "require_app('templates/footer.php')"),
        (r"include\s*\(\s*['\"]\.\/loginDocente\.php['\"]\s*\)", "require __DIR__ . '/../loginDocente.php'"),
        (r"include\s*\(\s*['\"]loginDocente\.php['\"]\s*\)", "require __DIR__ . '/../loginDocente.php'"),
        (r"include\s*\(\s*['\"]\.\/loginAlumno\.php['\"]\s*\)", "require __DIR__ . '/../loginAlumno.php'"),
        (r"include\s*\(\s*['\"]\.\/regDocente\.php['\"]\s*\)", "require __DIR__ . '/../regDocente.php'"),
        (r"include\s*\(\s*['\"]\.\/perfilAlumno\.php['\"]\s*\)", "require __DIR__ . '/../perfilAlumno.php'"),
        (r"include\s*\(\s*['\"]regConsulta\.php['\"]\s*\)", "require __DIR__ . '/../regConsulta.php'"),
        (r"include\s*\(\s*['\"]index\.php['\"]\s*\)", "require __DIR__ . '/../index.php'"),
        (r"include\s*\(\s*['\"]getAllAlumnos\.php['\"]\s*\)", "require_app('includes/getAllAlumnos.php')"),
        (r"include\s*\(\s*['\"]getAllDocentes\.php['\"]\s*\)", "require_app('includes/getAllDocentes.php')"),
        (r"include\s*\(\s*['\"]getAllConsultas\.php['\"]\s*\)", "require_app('includes/getAllConsultas.php')"),
        (r"include\s*\(\s*['\"]getAllMaterias\.php['\"]\s*\)", "require_app('includes/getAllMaterias.php')"),
        (r"include\s*\(\s*['\"]getMyConsultas\.php['\"]\s*\)", "require_app('includes/getMyConsultas.php')"),
        (r"include\s*\(\s*['\"]getMyConsultasAlumno\.php['\"]\s*\)", "require_app('includes/getMyConsultasAlumno.php')"),
        (r"include\s*\(\s*['\"]getMyConsultasRealizadas\.php['\"]\s*\)", "require_app('includes/getMyConsultasRealizadas.php')"),
        (r"include\s*\(\s*['\"]\.\/getAllMaterias\.php['\"]\s*\)", "require_app('includes/getAllMaterias.php')"),
        (r"\$_SERVER\[\"DOCUMENT_ROOT\"\]\s*\.\s*'/db\.php'", "app_path('config/db.php')"),
        (r"include\s*\(\s*\$_SERVER\[\"DOCUMENT_ROOT\"\]\s*\.\s*'/db\.php'\s*\)", "require_app('config/db.php')"),
        (r"include_once\s*\(\s*\$_SERVER\[\"DOCUMENT_ROOT\"\]\s*\.\s*'/destroySession\.php'\s*\)", "require_app('includes/destroySession.php')"),
        (r"include_once\s*\(\s*\$_SERVER\[\"DOCUMENT_ROOT\"\]\s*\.\s*'/isSessionStarted\.php'\s*\)", "require_app('includes/isSessionStarted.php')"),
        (r"include\s*\(\s*\$_SERVER\[\"DOCUMENT_ROOT\"\]\s*\.\s*\"\./loginAlumno\.php\"\s*\)", "require __DIR__ . '/../loginAlumno.php'"),
        (r"require\s+'\.\/PHPMailer/", "require __DIR__ . '/../lib/PHPMailer/"),
        (r"require\s+'\.\./PHPMailer/", "require __DIR__ . '/../lib/PHPMailer/"),
    ]

    for pattern, sub in repl:
        text = re.sub(pattern, sub, text)

    for old, new in ACTION_MAP.items():
        text = text.replace(old, new)

    if in_includes:
        text = text.replace("include_once('isSessionStarted.php')", "require_once __DIR__ . '/isSessionStarted.php'")
        text = re.sub(
            r"include\s*\(\s*['\"]index\.php['\"]\s*\)",
            "require __DIR__ . '/../index.php'",
            text,
        )

    return text


def main() -> None:
    for path in ROOT.rglob("*.php"):
        if any(part in SKIP_DIRS for part in path.parts):
            continue
        rel = path.relative_to(ROOT).as_posix()
        if rel.startswith("lib/"):
            continue
        original = path.read_text(encoding="utf-8", errors="replace")
        updated = patch_content(original, rel)
        if updated != original:
            path.write_text(updated, encoding="utf-8")
            print("patched", rel)


if __name__ == "__main__":
    main()
