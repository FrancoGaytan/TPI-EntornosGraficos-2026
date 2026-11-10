-- Datos de prueba para demo local / final
USE consultas_materias;

INSERT INTO materias (id, nombre_materia) VALUES
  (1, 'Entornos Gráficos'),
  (2, 'Matemática A'),
  (3, 'Sistemas Operativos');

-- Contraseñas en texto plano (como el código original; solo para demo local)
INSERT INTO profesores (legajo, nombre, apellido, email, contrasenia) VALUES
  (10001, 'Ricardo', 'Dario', 'rdario@gmail.com', '111111'),
  (10002, 'María', 'López', 'mlopez@utn.edu.ar', '111111');

INSERT INTO alumnos (legajo, nombre, apellido, email) VALUES
  (45791, 'Franco', 'Gaytán', 'gaytanfranco@gmail.com'),
  (45728, 'Federico', 'Navós', 'fedenavos@gmail.com'),
  (20001, 'Ricardo', 'Dario', 'rdario@gmail.com');

INSERT INTO administradores (legajo, nombre, apellido, email, contrasenia) VALUES
  (1, 'Admin', 'UTN', 'admin@utn.edu.ar', 'admin111');

-- Consultas futuras (ajustá fechas si importás mucho después de hoy)
INSERT INTO consultas (id, fecha_hora, cupo, id_profesor, id_materia, estado) VALUES
  (1, DATE_ADD(NOW(), INTERVAL 7 DAY), 5, 10001, 1, 1),
  (2, DATE_ADD(NOW(), INTERVAL 14 DAY), 3, 10002, 2, 1),
  (3, DATE_ADD(NOW(), INTERVAL 10 DAY), 2, 10001, 1, 1);

INSERT INTO alumno_consulta (legajo_alumno, id_consulta, cancelada) VALUES
  (45791, 1, 0);
