CREATE DATABASE library;
SET NAMES UTF8;
CREATE DATABASE IF NOT EXISTS library;
USE library;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users( 
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
apellidos       varchar(255) not null,
email           varchar(255) not null,
phone           varchar(255) not null,
password        varchar(255) not null,
rol             varchar(20) DEFAULT 'user',
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)  
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS categoria;
CREATE TABLE IF NOT EXISTS categoria(
id              int(255) auto_increment not null,
nombre          varchar(255) not null,
descripcion     varchar(255) not null,
CONSTRAINT pk_categoria PRIMARY KEY(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS autor;
CREATE TABLE IF NOT EXISTS autor(
id              int(255) auto_increment not null,
nombre          varchar(255) not null,
apellidos       varchar(255) not null,
biografia       varchar(255) not null,
nacionalidad    varchar(255) not null,
fecha_nacimiento    date not null,
fecha_fallecimiento date null,
CONSTRAINT pk_autor PRIMARY KEY(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS libros;
CREATE TABLE IF NOT EXISTS libros(
id                  int(255) auto_increment not null,
titulo              varchar(255) not null,
descripcion         varchar(255) not null,
stock               varchar(255) not null,
stock_reserva       varchar(255) not null,
categoria_id        int(255) not null,
autor_id            int(255) not null,
fecha_publicacion   date not null,
CONSTRAINT pk_libros PRIMARY KEY(id),
FOREIGN KEY(categoria_id) REFERENCES categoria(id),
FOREIGN KEY(autor_id) REFERENCES autor(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS compras;
CREATE TABLE IF NOT EXISTS compras(
id              int(255) auto_increment not null,
usuario_id      int(255) not null,
libro_id        int(255) not null,
CONSTRAINT pk_compras PRIMARY KEY(id),
FOREIGN KEY(usuario_id) REFERENCES users(id),
FOREIGN KEY(libro_id) REFERENCES libros(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS comentarios;
CREATE TABLE IF NOT EXISTS comentarios(
id              int(255) auto_increment not null,
fecha_publicacion   date not null,
texto           varchar(255) not null,
usuario_id      int(255) not null,
libro_id        int(255) not null,
CONSTRAINT comentarios PRIMARY KEY(id),
FOREIGN KEY(usuario_id) REFERENCES users(id),
FOREIGN KEY(libro_id) REFERENCES libros(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS valoraciones;
CREATE TABLE IF NOT EXISTS valoraciones(
id              int(255) auto_increment not null,
valoraciones    varchar(255) not null,
usuario_id      int(255) not null,
libro_id        int(255) not null,
CONSTRAINT valoraciones PRIMARY KEY(id),
FOREIGN KEY(usuario_id) REFERENCES users(id),
FOREIGN KEY(libro_id) REFERENCES libros(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS reservas;
CREATE TABLE IF NOT EXISTS reservas(
id              int(255) auto_increment not null,
fecha_reserva   date not null,
usuario_id      int(255) not null,
libro_id        int(255) not null,
CONSTRAINT reservas PRIMARY KEY(id),
FOREIGN KEY(usuario_id) REFERENCES users(id),
FOREIGN KEY(libro_id) REFERENCES libros(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




INSERT INTO users VALUES (NULL, "Admin", "Admin", "admin@admin.es", "123123123", "$2y$04$iL8idZGac1b4k6tsPTi1zuxWOzUyNEJxYBq7Of5O84TZCZHcVV5ya","admin");


INSERT INTO categoria
VALUES
    (NULL, 'Aventuras', 'Libros llenos de emoción y acción'),
    (NULL, 'Ficcion-Novela', 'Libros que exploran futuros posibles basados en la ciencia y la tecnología.'),
    (NULL, 'Suspense-Intriga', 'Libros que generan tensión y expectativas al lector.'),
    (NULL, 'Poesía', 'Libros que contienen expresiones artísticas y emocionales en forma de poemas.'),
    (NULL, 'Filosofía', 'Libros que tratan sobre problemas fundamentales como la existencia, conocimiento, la verdad...'),
    (NULL, 'Policiaca', 'Libros que se centran en la resolución de un enigma o crimen.'),
    (NULL, 'Cuentos', 'Libros infantiles de tema simple y personajes poco realistas.'),
    (NULL, 'Fantasía', 'Libros de narrativa, con elementos sobrenaturales y criaturas fantásticas.'),
    (NULL, 'Realismo mágico', 'Obra literaria que se escribe con la intención de entretener y divertir a los lectores.'),
    (NULL, 'Autoayuda', 'Libros que son auténticos manuales de comportamiento.'),
    (NULL, 'Histórico', 'Libros basados en eventos y periodos históricos.'),
    (NULL, 'Cocina', 'Libros con recetas y consejos culinarios.'),
    (NULL, 'Realismo social', 'Libros que reflejan la realidad social en la que se encuentran.');


INSERT INTO autor
VALUES
    (NULL, 'Brandon', 'Sanderson', 'Fue seleccionado para completar el libro final de la serie de fantasía épica "La rueda del tiempo", tras la muerte de Robert Jordan. A partir de ahí le sucedieron numerosos contratos y el reconocimiento internacional.', 'EE.UU.', '1975-12-19', NULL),
    (NULL, 'Juan Jose', 'Benítez López', 'Es un periodista y escritor español, conocido por sus trabajos dedicados a la ufología.', 'Española', '1946-09-07', NULL),
    (NULL, 'Arturo', 'Pérez Reverte', 'Nacido en Murcia, licenciado en periodismo en la complutense, reportero de guerra. Escritor, periodista y académico español. Como escritor y novelista tiene innumerables premios.', 'Española', '1951-11-25', NULL),
    (NULL, 'Gabriel', 'García Márquez', 'Reconocido por sus novelas y cuentos. Estudió periodismo en la universidad de Colombia. Premio Nobel de Literatura en 1982.', 'Colombia', '1927-03-06', '2014-04-17'),
    (NULL, 'Alejo', 'Carpentier y Valmont', 'Aunque nacido en Suiza, vivió toda su infancia en Cuba. Terminó sus estudios en París. Estudió música y periodismo. Escribió novelas, cuentos, ensayos, libreto de ópera...', 'Cubana-Francesa', '1904-12-26', '1980-04-24'),
    (NULL, 'Carlos', 'Ruiz Zafón', 'Estudió ciencias de la información en Barcelona y se dedicó a la publicidad. En 1993 publicó su primera novela "El príncipe de la Niebla". Finalista del Premio Fernando Lara de Novela. Falleció en Los Ángeles a los 55 años de cáncer de colon.', 'Española', '1964-09-25', '2020-06-19'),
    (NULL, 'Miguel', 'Delibes Setién', 'Miembro de la RAE desde 1975. Licenciado en comercio. Dibujante de caricaturas, columnista y periodista. Premio Cervantes y Premio Príncipe de Asturias de las letras.', 'Española', '1920-10-17', '2010-03-12'),
    (NULL, 'Carmen', 'Martín Gaite', 'Premio Príncipe de Asturias de las letras en 1988. Licenciada en Filología románica. Trabajó en la RAE. Premio Nadal y Premio Café Gijón. Premio Príncipe de Asturias en 1978.', 'Española', '1925-12-08', '2000-07-23'),
    (NULL, 'Luis', 'Martín-Santos Rivera', 'Escritor y psiquiatra español. Colaborador de CSIC.', 'Española', '1924-11-11', '1964-01-21'),
    (NULL, 'Rafael', 'Santandreu Lorite', 'Psicólogo y profesor de la Universidad Ramon Llull. Actualmente se dedica a la autoayuda y la psicoterapia.', 'Española', '1969-12-08', NULL),
    (NULL, 'Jostein', 'Gaarder', 'Premio nacional de crítica literaria en Noruega.', 'Noruego', '1952-08-08', NULL),
    (NULL, 'Federico', 'García Lorca', 'Poeta español de la Generación del 27. Falleció fusilado en la guerra civil española.', 'Española', '1898-06-05', '1936-08-18'),
    (NULL, 'Karlos', 'Arguiñano Urkiola', 'Cocinero, presentador de televisión, escritor y empresario. Estrella Michelin de 1982 a 1998.', 'Española', '1948-09-06', NULL),
    (NULL, 'Mika', 'Toimi Waltari', 'Autor muy prolífico, hijo de profesor de secundaria. Sus obras han sido traducidas a más de 30 idiomas.', 'Finlandia', '1908-09-19', '1979-08-26'),
    (NULL, 'John', 'Steven "Jay" Kordich', 'Jugó al fútbol americano universitario. Autor de éxito de ventas del New York Times.', 'EE.UU.', '1923-08-27', '2017-05-27'),
    (NULL, 'Mari', 'Renault', 'Estudió en la Universidad de Oxford. Se instruyó en enfermería en la Academia Radcliffe. Sirvió como enfermera en la Segunda Guerra Mundial.', 'GBR/Sudafricana', '1905-09-04', '1983-12-13'),
    (NULL, 'Clara', 'Sánchez', 'Escritora, filóloga especialista en cine español. Premios en narrativa: Alfaguara, Nadal y Planeta. En 2023 es miembro de la RAE.', 'Española', '1955-03-01', NULL),
    (NULL, 'Javier', 'Sierra Albert', 'Licenciado en Ciencias de la Información por la Complutense. Consejero editorial de la revista "Más allá de la ciencia". Participa en varios programas de televisión. Premio Planeta en 2017.', 'Española', '1971-08-11', NULL),
    (NULL, 'Kenneth', 'Martin Follett', 'Aprendió a leer a los 4 años. Estudió filosofía en University College of London. Trabajó como reportero y publicó su primer libro en 1974.', 'Británica', '1949-06-05', NULL),
    (NULL, 'Eduardo', 'Mendicutti', 'Estudió periodismo. Crítico literario y colaborador del periódico El Mundo. Premio Sésamo con su primera obra "Tatuaje".', 'Española', '1948-03-24', NULL);


-- INSERT INTO libros
-- VALUES
--     (1, 'El Imperio final', 'Trata de salvar la humanidad del terror de "la Profundidad". Tiene lugar en un equivalente a principios del siglo XVIII', 0, 0, 8, 1, '2006-07-17'),
--     (2, 'Caballo de Troya I', 'Es una versión de la vida de Jesús, que difiere de las creencias y doctrinas del cristianismo.', 0, 0, 2, 2, '1984-12-09'),
--     (3, 'La Tabla de Flandes', 'El libro se fundamenta en una trama que mezcla novela histórica y policiaca, con el arte y el ajedrez como grandes temas.', 0, 0, 6, 3, '1994-07-08'),
--     (4, 'Cien años de soledad', 'Historia de la familia Buendía a lo largo de siete generaciones en el pueblo ficticio de Macondo.', 0, 0, 9, 4, '1967-03-05'),
--     (5, 'El siglo de las luces', 'Ambientada en la época de la Revolución Francesas, pero desarrollada en el Caribe. Se desenvuelve a través de las vivencias de tres jóvenes.', 0, 0, 9, 5, '1962-01-01'),
--     (6, 'La sombra del viento', 'El protagonista Daniel intenta descubrir un misterio que le cambiará la vida.', 0, 0, 3, 6, '2001-01-01'),
--     (7, 'El camino', 'Ambientada en la España rural de la posguerra.', 0, 0, 2, 7, '1950-01-01'),
--     (8, 'Entre visillos', 'Los personajes femeninos desvelan el vacío de sus vidas y encaran su existencia.', 0, 0, 13, 8, '1958-01-01'),
--     (9, 'Tiempo de Silencio', 'Libro que muestra la realidad social y económica de la época.', 0, 0, 13, 9, '1962-01-01'),
--     (10, 'Sin Miedo', 'Se trata de un manual de autoterapia para vencer la ansiedad, las obsesiones y cualquier temor irracional.', 0, 0, 10, 10, '2021-12-07'),
--     (11, 'Sueños', 'Inventario sobre sus más secretas preocupaciones. Posibilidad de que los ovnis estén cerca de la Tierra.', 0, 0, 5, 2, '1982-01-01'),
--     (12, 'El mundo de Sofía', 'Una joven irá conociendo su propia identidad, mientras descubre la historia de la filosofía occidental.', 0, 0, 5, 11, '1991-01-01'),
--     (13, 'El capitán Alatriste', 'Ambientada en Madrid del siglo XVII. Narra las aventuras del personaje junto con su paje.', 0, 0, 1, 3, '1996-01-01'),
--     (14, 'A solas con la mar', 'Es un resumen poético de las vivencias del autor durante el verano de 1983 en Barbate.', 0, 0, 4, 2, '1990-01-01'),
--     (15, 'El romancero gitano', 'Cultura gitana relacionándolo con temas como la noche, la muerte, el cielo y la luna.', 0, 0, 4, 12, '1928-01-01'),
--     (16, 'Doce cuentos peregrínos', 'Cuenta cuentos que parecen realidad. O crónicas que parecen sueños de un poeta.', 0, 0, 7, 4, '1992-01-01'),
--     (17, 'Cocina fácil y rico.', 'Más de 600 recetas de cocina que se pueden elaborar fácilmente. Para hacerte la vida más cómoda y agradable.', 0, 0, 12, 13, '2022-11-09'),
--     (18, 'Sinuhé el Egipcio', 'Refiere las aventuras de un médico egipcio por el mundo antiguo.', 0, 0, 11, 14, '1945-01-01'),
--     (19, 'El poder de los zumos', 'Ofrece una vida saludable con frescos zumos naturales.', 0, 0, 12, 15, '1993-05-15'),
--     (20, 'El muchacho persa', 'Narra las hazañas de un joven persa de familia aristocrática.', 0, 0, 11, 16, '1972-01-01'),
--     (21, 'Lo que esconde tu nombre', 'Una joven embarazada, Sandra, decide retirarse a la costa de Levante para decidir qué hacer con su vida.', 0, 0, 2, 17, '2010-02-04'),
--     (22, 'El Angel perdido', 'Mientras trabaja en la restauración del Pórtico de la Gloria de Santiago de Compostela, Julia Alvarez recibe una noticia: su marido ha sido secuestrado en Turquía. Se verá envuelta en una carrera por controlar dos piedras que permiten el contacto con entidades sobrenaturales y por las que está interesado tanto el presidente de los EE.UU como una misteriosa secta oriental.', 0, 0, 1, 18, '2011-05-07'),
--     (23, 'La caída de los gigantes', 'Narra la historia de cinco familias durante los años turbulentos de la Primera Guerra Mundial, la Revolución rusa y la lucha de hombres y mujeres por sus derechos.', 0, 0, 11, 19, '2010-09-28'),
--     (24, 'El beso del cosaco', 'Tras más de sesenta años de ausencia, Elsa Medina Osorio aparece un día en La Desembocadura, el viejo caserón familiar, que reconoce enseguida por un inconfundible olor a papas con alcauciles y al que vuelve para celebrar una gran fiesta antes de morir.', 0, 0, 2, 20, '2000-01-01'),
--     (25, 'Elantris', 'La ciudad de Elantris, poderosa y bella capital de Arelon, había sido llamada la «ciudad de los dioses». Antaño famosa sede de inmortales, lugar repleto de poderosa magia, Elantris ha caído en desgracia. Ahora solo acoge a los nuevos «muertos en vida», postrados en una insufrible «no-vida» tras una misteriosa y terrible transformación.', 0, 0, 8, 1, '2005-04-21'),
--     (26, 'El maestro de esgrima', 'En Madrid, en un tiempo cortesano y provinciano, bajo el reinado de Isabel ll, la política ameniza las tertulias con sus dimes y diretes, y sus avatares son ocasión para el nepotismo, la traición o la venganza.', 0, 0, 1, 3, '1988-03-17'),
--     (27, 'El Papa rojo', '“El Papa rojo” cuenta el posible asesinato del Papa Juan Pablo II. La historia se narra siguiendo dos líneas argumentales: una en tiempo real, en la cual se nos cuenta el descubrimiento del hecho trascendental de encontrar el cadáver del primer mandatario de la Iglesia Romana.', 0, 0, 6, 2, '1992-01-01'),
--     (28, 'El laberinto de los espíritus.', 'Daniel Sempere, Fermín Romero de Torres y la Librería Sempere e Hijos vuelven a ser protagonistas en la Barcelona de la década de los años 50. Daniel, asediado por la rabia y la necesidad de vengar la muerte de su madre, Isabella, descubrirá un entramado de crímenes y violaciones del régimen de Francisco Franco que un nuevo personaje, Alicia Gris, ayudará a resolver.', 0, 0, 3, 6, '2016-11-17'),
--     (29, 'La sombra del ciprés es alargada', 'El protagonista de esta historia es Pedro, un niño que quedó huérfano a temprana edad. Pedro es también el narrador y nos cuenta cómo, al morir sus padres, quedó bajo la tutela de su tío Félix, quien lo envió al Ávila para que el profesor Lesmes se encargara de su educación.', 0, 0, 2, 7, '1948-01-01'),
--     (30, 'Crónica de una muerte anunciada', 'Relata la historia del asesinato de Santiago Nasar, un joven de 21 años, con ascendencia árabe y católico, quien gobernaba la hacienda de su difunto padre y estaba comprometido con Flora Miguel', 0, 0, 6, 4, '1981-01-01');
    




