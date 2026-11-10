-- TPI Módulo Aviso de Consultas — esquema inferido del código PHP
-- Base: consultas_materias

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP DATABASE IF EXISTS consultas_materias;
CREATE DATABASE consultas_materias
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE consultas_materias;

CREATE TABLE materias (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre_materia VARCHAR(120) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE profesores (
  legajo INT UNSIGNED NOT NULL,
  nombre VARCHAR(80) NOT NULL,
  apellido VARCHAR(80) NOT NULL,
  email VARCHAR(120) NOT NULL,
  contrasenia VARCHAR(255) NOT NULL,
  PRIMARY KEY (legajo),
  UNIQUE KEY uk_profesores_email (email)
) ENGINE=InnoDB;

CREATE TABLE alumnos (
  legajo INT UNSIGNED NOT NULL,
  nombre VARCHAR(80) NOT NULL,
  apellido VARCHAR(80) NOT NULL,
  email VARCHAR(120) NOT NULL,
  PRIMARY KEY (legajo),
  UNIQUE KEY uk_alumnos_email (email)
) ENGINE=InnoDB;

CREATE TABLE administradores (
  legajo INT UNSIGNED NOT NULL,
  nombre VARCHAR(80) NOT NULL,
  apellido VARCHAR(80) NOT NULL,
  email VARCHAR(120) NOT NULL,
  contrasenia VARCHAR(255) NOT NULL,
  PRIMARY KEY (legajo),
  UNIQUE KEY uk_admin_email (email)
) ENGINE=InnoDB;

-- estado: 1 = activa, 0 = bloqueada, 2 = cancelada (según uso en PHP)
CREATE TABLE consultas (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  fecha_hora DATETIME NOT NULL,
  cupo INT NOT NULL DEFAULT 0,
  id_profesor INT UNSIGNED NOT NULL,
  id_materia INT UNSIGNED NOT NULL,
  estado TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  KEY idx_consultas_fecha (fecha_hora),
  KEY idx_consultas_profesor (id_profesor),
  KEY idx_consultas_materia (id_materia),
  CONSTRAINT fk_consultas_profesor
    FOREIGN KEY (id_profesor) REFERENCES profesores (legajo)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_consultas_materia
    FOREIGN KEY (id_materia) REFERENCES materias (id)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE alumno_consulta (
  legajo_alumno INT UNSIGNED NOT NULL,
  id_consulta INT UNSIGNED NOT NULL,
  cancelada TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (legajo_alumno, id_consulta),
  KEY idx_ac_consulta (id_consulta),
  CONSTRAINT fk_ac_alumno
    FOREIGN KEY (legajo_alumno) REFERENCES alumnos (legajo)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_ac_consulta
    FOREIGN KEY (id_consulta) REFERENCES consultas (id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;
