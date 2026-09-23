-- Datos minimos para poder entrar y ver la aplicacion con contenido.
-- Sin esto las tablas estan vacias y todas las pantallas salen en blanco.
-- Contrasena de los dos usuarios: prova1234
--
-- Importar con:  mysql -u root < db/datos-ejemplo.sql

USE incidencies;

INSERT IGNORE INTO users (id, name, email, password, rol_usuari, created_at, updated_at) VALUES
  (1, 'Alex Aiguade', 'alex@example.com',  '$2y$10$doIxVYWBh2uN1sKyVx/k3OvgVyQMQ6usKUw/XpQFJY3I7MD.LGgA.', 'profesor',  NOW(), NOW()),
  (2, 'Marta Puig',   'marta@example.com', '$2y$10$doIxVYWBh2uN1sKyVx/k3OvgVyQMQ6usKUw/XpQFJY3I7MD.LGgA.', 'reparador', NOW(), NOW());

INSERT IGNORE INTO categories (id, tipus, reparador_id, created_at, updated_at) VALUES
  (1, 'Informatica', 2, NOW(), NOW()),
  (2, 'Electricitat', 2, NOW(), NOW()),
  (3, 'Mobiliari',   2, NOW(), NOW()),
  (4, 'Climatitzacio', 2, NOW(), NOW());

INSERT IGNORE INTO incidencies (id, titol, descripcio, data, hora, estat, lloc, user_id, categoria_id, created_at, updated_at) VALUES
  (1, 'Projector que no encen',      'El projector de l aula no dona senyal amb cap portatil.', '2026-09-21', '09:15:00', 'Pendent',  'Aula A12',      1, 1, NOW(), NOW()),
  (2, 'Endoll cremat',                'Fa olor de cremat i ha saltat el diferencial.',           '2026-09-21', '11:40:00', 'En curs',  'Taller B04',    1, 2, NOW(), NOW()),
  (3, 'Cadira trencada',              'La base de la cadira esta partida i no aguanta.',         '2026-09-22', '08:05:00', 'Pendent',  'Sala de juntes',1, 3, NOW(), NOW()),
  (4, 'Aire condicionat degotant',    'Cau aigua sobre les taules del fons.',                    '2026-09-22', '15:30:00', 'En curs',  'Aula A07',      1, 4, NOW(), NOW()),
  (5, 'Ordinador que no arrenca',     'Fa tres pitos i la pantalla es queda negra.',             '2026-09-23', '10:00:00', 'Resolt',   'Aula B02',      1, 1, NOW(), NOW()),
  (6, 'Fluorescent parpellejant',     'Parpelleja tot el dia i molesta per llegir.',             '2026-09-23', '12:20:00', 'Pendent',  'Passadis 2',    1, 2, NOW(), NOW());
