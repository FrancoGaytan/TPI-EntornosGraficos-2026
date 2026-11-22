-- Datos de prueba. La clave de los docentes es 111111.
USE consultas_materias;

INSERT INTO materias (id, nombre_materia) VALUES
  (1, 'Análisis Matemático I'),
  (2, 'Álgebra y Geometría Analítica'),
  (3, 'Matemática Discreta'),
  (4, 'Sistemas y Organizaciones'),
  (5, 'Algoritmos y Estructuras de Datos'),
  (6, 'Arquitectura de Computadoras'),
  (7, 'Física I'),
  (8, 'Inglés I'),
  (9, 'Química'),
  (10, 'Análisis Matemático II'),
  (12, 'Análisis de Sistemas'),
  (13, 'Sintaxis y Semántica de los Lenguajes'),
  (14, 'Paradigmas de Programación'),
  (15, 'Sistemas Operativos'),
  (16, 'Sistemas de Representación'),
  (17, 'Probabilidades y Estadísticas'),
  (18, 'Diseño de Sistemas'),
  (19, 'Comunicaciones'),
  (20, 'Matemática Superior'),
  (21, 'Gestión de Datos'),
  (23, 'Economía'),
  (24, 'Inglés II'),
  (25, 'Redes de Información'),
  (26, 'Administración de Recursos'),
  (27, 'Investigación Operativa'),
  (28, 'Simulación'),
  (29, 'Ingeniería de Software'),
  (30, 'Teoría de Control'),
  (31, 'Legislación'),
  (32, 'Proyecto Final'),
  (34, 'Administración Gerencial'),
  (35, 'Sistemas de Gestión'),
  (40, 'Entornos Gráficos'),
  (42, 'Sistemas de Información Integrados para la Industria'),
  (43, 'Informática en la Administración Pública'),
  (50, 'Comunicaciones y Redes'),
  (51, 'Habilitación Profesional'),
  (52, 'Gestión Ingenieril'),
  (53, 'Lenguaje orientado a la Administración Comercial (COBOL)'),
  (54, 'Lenguaje de Programación JAVA'),
  (56, 'Introducción a la práctica Profesional'),
  (57, 'Algoritmos Genéticos'),
  (58, 'Gestión de trabajos con sistema operativo de Funciones avanzadas'),
  (59, 'Metodología de la Investigación'),
  (60, 'Dirección de Recursos Humanos'),
  (61, 'Minería de Datos'),
  (62, 'Formación de Emprendedores'),
  (63, 'Infraestructura Tecnológica'),
  (65, 'Análisis y Diseño de Datos e información'),
  (67, 'Gestión de Procesos de Negocio'),
  (68, 'Técnicas y Tecnologías Avanzadas de Desarrollo de Software'),
  (69, 'Tecnologías de Desarrollo Móviles'),
  (70, 'Tecnología Educativa');

INSERT INTO profesores (legajo, nombre, apellido, email, contrasenia) VALUES
  (10001, 'Ricardo', 'Dario', 'rdario@gmail.com', '111111'),
  (31001, 'Rosa', 'Maenza', 'maenza.rosa@demo.frro.utn.edu.ar', '111111'),
  (31002, 'Claudia', 'Moyano', 'moyano.claudia@demo.frro.utn.edu.ar', '111111'),
  (31003, 'Claudia', 'Dania', 'dania.claudia@demo.frro.utn.edu.ar', '111111'),
  (31004, 'Mario', 'Bressano', 'bressano.mario@demo.frro.utn.edu.ar', '111111'),
  (31005, 'Alejandro', 'Rozas', 'rozas.alejandro@demo.frro.utn.edu.ar', '111111'),
  (31006, 'Mónica', 'Jäger', 'jager.monica@demo.frro.utn.edu.ar', '111111'),
  (31007, 'Carlos', 'Geremía', 'geremia.carlos@demo.frro.utn.edu.ar', '111111'),
  (31008, 'Hernán', 'Tomé Catalá', 'tome.hernan@demo.frro.utn.edu.ar', '111111'),
  (31009, 'Enrique', 'Porta', 'porta.enrique@demo.frro.utn.edu.ar', '111111'),
  (31010, 'Jorge', 'Campanaro', 'campanaro.jorge@demo.frro.utn.edu.ar', '111111'),
  (31011, 'Jorge', 'Flamini', 'flamini.jorge@demo.frro.utn.edu.ar', '111111'),
  (31012, 'Fabiana María', 'Riva', 'riva.fabiana@demo.frro.utn.edu.ar', '111111'),
  (31013, 'Hernán', 'Vitri', 'vitri.hernan@demo.frro.utn.edu.ar', '111111'),
  (31014, 'Guillermo', 'Leale', 'leale.guillermo@demo.frro.utn.edu.ar', '111111'),
  (31015, 'Luciano', 'Ripani', 'ripani.luciano@demo.frro.utn.edu.ar', '111111'),
  (31016, 'Cristian', 'Bigatti', 'bigatti.cristian@demo.frro.utn.edu.ar', '111111'),
  (31017, 'María Norma', 'Camperchioli', 'camperchioli.maria@demo.frro.utn.edu.ar', '111111'),
  (31018, 'Jose', 'Albano', 'albano.jose@demo.frro.utn.edu.ar', '111111'),
  (31019, 'Hernán', 'Cornejo', 'cornejo.hernan@demo.frro.utn.edu.ar', '111111'),
  (31020, 'Luis', 'Feraboli', 'feraboli.luis@demo.frro.utn.edu.ar', '111111'),
  (31021, 'Daniela', 'Díaz', 'diaz.daniela@demo.frro.utn.edu.ar', '111111'),
  (31022, 'Ezequiel', 'Porta', 'porta.ezequiel@demo.frro.utn.edu.ar', '111111'),
  (31023, 'Milton', 'Buzey Rocci', 'buzey.milton@demo.frro.utn.edu.ar', '111111'),
  (31024, 'María', 'Farías', 'farias.maria@demo.frro.utn.edu.ar', '111111'),
  (31025, 'Ricardo', 'Tabacman', 'tabacman.ricardo@demo.frro.utn.edu.ar', '111111'),
  (31026, 'Jorge', 'Arias', 'arias.jorge@demo.frro.utn.edu.ar', '111111'),
  (31027, 'Miguel', 'Guillaumet', 'guillaumet.miguel@demo.frro.utn.edu.ar', '111111'),
  (31028, 'Roberto', 'Albanese', 'albanese.roberto@demo.frro.utn.edu.ar', '111111'),
  (31029, 'Gabriela', 'Font', 'font.gabriela@demo.frro.utn.edu.ar', '111111'),
  (31030, 'Adrián', 'Meca', 'meca.adrian@demo.frro.utn.edu.ar', '111111'),
  (31031, 'Julian Gabriel', 'Butti', 'jbutti@frro.utn.edu.ar', '111111');

INSERT INTO alumnos (legajo, nombre, apellido, email) VALUES
  (45791, 'Franco', 'Gaytán', 'gaytanfranco@gmail.com'),
  (45728, 'Federico', 'Navós', 'fedenavos@gmail.com'),
  (20001, 'Ricardo', 'Dario', 'rdario@gmail.com');

INSERT INTO administradores (legajo, nombre, apellido, email, contrasenia) VALUES
  (1, 'Admin', 'UTN', 'admin@utn.edu.ar', 'admin111');

INSERT INTO profesor_materia (legajo_profesor, id_materia) VALUES
  (10001, 40),
  (31001, 3),
  (31002, 4),
  (31003, 5),
  (31004, 6),
  (31005, 12),
  (31006, 13),
  (31007, 14),
  (31008, 15),
  (31009, 18),
  (31010, 19),
  (31011, 20),
  (31012, 21),
  (31013, 25),
  (31012, 26),
  (31014, 27),
  (31014, 28),
  (31015, 29),
  (31016, 30),
  (31017, 31),
  (31018, 32),
  (31019, 34),
  (31020, 35),
  (31021, 40),
  (31031, 40),
  (31022, 42),
  (31023, 43),
  (31013, 50),
  (31009, 51),
  (31002, 52),
  (31024, 53),
  (31025, 54),
  (31009, 56),
  (31021, 57),
  (31026, 58),
  (31027, 59),
  (31028, 60),
  (31016, 61),
  (31026, 63),
  (31029, 65),
  (31030, 68);

INSERT INTO consultas (id, fecha_hora, cupo, id_profesor, id_materia, estado) VALUES
  (1, DATE_ADD(NOW(), INTERVAL 7 DAY), 8, 31021, 40, 1),
  (2, DATE_ADD(NOW(), INTERVAL 10 DAY), 5, 10001, 40, 1),
  (3, DATE_ADD(NOW(), INTERVAL 14 DAY), 6, 31008, 15, 1);

INSERT INTO alumno_consulta (legajo_alumno, id_consulta, cancelada) VALUES
  (45791, 1, 0);

-- Consultas de ejemplo para las próximas semanas.
INSERT INTO consultas (fecha_hora, cupo, id_profesor, id_materia, estado)
SELECT
  TIMESTAMP(
    DATE_ADD(
      DATE_ADD(
        DATE_ADD(CURDATE(), INTERVAL ((9 - DAYOFWEEK(CURDATE())) MOD 7) DAY),
        INTERVAL IF(((9 - DAYOFWEEK(CURDATE())) MOD 7) = 0, 7, 0) DAY
      ),
      INTERVAL (w.n * 7 + (pm.legajo_profesor MOD 5)) DAY
    ),
    MAKETIME(16 + (pm.id_materia MOD 4), (pm.legajo_profesor MOD 4) * 15, 0)
  ),
  6 + (pm.id_materia MOD 5),
  pm.legajo_profesor,
  pm.id_materia,
  1
FROM profesor_materia pm
CROSS JOIN (
  SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
) w;

