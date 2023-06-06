
CREATE DATABASE comidas;

USE comidas;

CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  apellidos VARCHAR(50) NOT NULL,
  nombre_usuario VARCHAR(50) UNIQUE NOT NULL,
  correo VARCHAR(100) UNIQUE NOT NULL,
  pass VARCHAR(100) NOT NULL,
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nombre, apellidos, nombre_usuario, correo, pass)
VALUES ('Juan', 'Pérez García', 'juanpg', 'juanpg@gmail.com', 'micontrasena1'),
       ('María', 'González López', 'mariag', 'mariag@gmail.com', 'micontrasena2'),
       ('Carlos', 'Martínez Sánchez', 'carlosm', 'carlosm@gmail.com', 'micontrasena3'),
       ('Ana', 'Sánchez Rodríguez', 'anas', 'anas@gmail.com', 'micontrasena4');


CREATE TABLE paises (
  id_pais INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL
);

INSERT INTO paises (nombre) VALUES
  ('Argentina'),
  ('Brasil'),
  ('Canadá'),
  ('Dinamarca'),
  ('Egipto');

  CREATE TABLE categorias (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria VARCHAR(255) UNIQUE NOT NULL
);


INSERT INTO categorias (nombre_categoria) VALUES
    ('Postres'),
    ('Ensaladas'),
    ('Pizzas'),
    ('Sopas');



CREATE TABLE ingredientes (
  id_ingrediente INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL
);

INSERT INTO ingredientes (nombre) VALUES
  ('Harina'),
  ('Azúcar'),
  ('Leche'),
  ('Huevos'),
  ('Mantequilla');


CREATE TABLE recetas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) UNIQUE NOT NULL,
    descripcion TEXT,
    consejos TEXT,
    tiempo_preparacion INT,
    dificultad ENUM('Fácil', 'Media', 'Difícil'),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT,
    id_pais INT,
    id_categoria INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_pais) REFERENCES paises(id_pais),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);


INSERT INTO recetas (nombre, descripcion, consejos, tiempo_preparacion, dificultad, id_usuario, id_pais) VALUES
  ('Torta de Chocolate', 'Deliciosa torta de chocolate con cobertura', 'Decora con chispas de chocolate', 60, 'Media', 1, 3),
  ('Pasta Carbonara', 'Clásica receta italiana de pasta con panceta y huevo', 'Agrega queso parmesano rallado al servir', 30, 'Fácil', 2, 2),
  ('Ensalada César', 'Ensalada fresca con pollo a la parrilla y aderezo césar', 'Añade crutones crujientes', 20, 'Fácil', 3, 1);



CREATE TABLE recetas_ingredientes (
    id_receta INT,
    id_ingrediente INT,
    cantidad VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_receta, id_ingrediente),
    FOREIGN KEY (id_receta) REFERENCES recetas(id),
    FOREIGN KEY (id_ingrediente) REFERENCES ingredientes(id_ingrediente)
);


INSERT INTO recetas_ingredientes (id_receta, id_ingrediente, cantidad) VALUES
  (1, 1, '200 gramos'),
  (1, 2, '150 gramos'),
  (1, 3, '1 taza'),
  (2, 4, '3 unidades'),
  (2, 5, '50 gramos'),
  (3, 3, '2 tazas'),
  (3, 5, '100 gramos');



CREATE TABLE instrucciones (
  id_instruccion INT PRIMARY KEY AUTO_INCREMENT,
  instruccion VARCHAR(255) NOT NULL,
  id_receta INT,
  FOREIGN KEY (id_receta) REFERENCES recetas(id)
);

INSERT INTO instrucciones (instruccion, id_receta) VALUES
  ('Precalienta el horno a 180 grados Celsius.', 1),
  ('En un tazón, mezcla la harina, el azúcar y la sal.', 1),
  ('Añade la mantequilla y mezcla hasta obtener una textura de migas.', 1),
  ('Incorpora los huevos y la leche, mezclando hasta obtener una masa homogénea.', 1),
  ('Vierte la masa en un molde previamente engrasado.', 1),
  ('Hornea durante 30 minutos o hasta que esté dorada.', 1),
  ('Deja enfriar antes de servir.', 1),
  ('Cocina la pasta en agua hirviendo con sal según las instrucciones del paquete.', 2),
  ('En una sartén, cocina la panceta hasta que esté crujiente.', 2),
  ('Escurre la pasta y resérvala.', 2),
  ('En un tazón aparte, bate los huevos y añade el queso rallado.', 2),
  ('Añade la pasta y la panceta a la mezcla de huevos y queso.', 2),
  ('Mezcla bien hasta que todos los ingredientes estén integrados.', 2),
  ('Sirve caliente y espolvorea con perejil fresco.', 2),
  ('Lava y corta las hojas de lechuga.', 3),
  ('Cocina el pollo a la parrilla y córtalo en tiras.', 3),
  ('Prepara el aderezo césar mezclando el aceite de oliva, el jugo de limón, el ajo picado y el queso parmesano.', 3),
  ('En un tazón grande, mezcla la lechuga, el pollo y el aderezo césar.', 3),
  ('Añade crutones crujientes y mezcla suavemente.', 3),
  ('Sirve la ensalada césar y disfruta.', 3);




CREATE TABLE imagenes (
  id_imagen INT PRIMARY KEY AUTO_INCREMENT,
  url VARCHAR(255) NOT NULL,
  id_receta INT,
  FOREIGN KEY (id_receta) REFERENCES recetas(id)
);

INSERT INTO imagenes (url, id_receta) VALUES
  ('https://example.com/imagen1.jpg', 1),
  ('https://example.com/imagen2.jpg', 1),
  ('https://example.com/imagen3.jpg', 2),
  ('https://example.com/imagen4.jpg', 3),
  ('https://example.com/imagen5.jpg', 3);



CREATE TABLE comentarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  comentario TEXT NOT NULL,
  fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id_usuario INT,
  id_receta INT NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
  FOREIGN KEY (id_receta) REFERENCES recetas(id)
);

INSERT INTO comentarios (comentario, id_usuario, id_receta) VALUES
  ('¡Esta receta de torta de chocolate es increíble!', 1, 1),
  ('Me encanta esta torta, siempre la hago para los cumpleaños', 2, 1),
  ('La pasta carbonara es mi plato italiano favorito', 3, 2),
  ('¡Deliciosa receta, la recomiendo!', 4, 2),
  ('La ensalada césar es perfecta para una comida ligera', 1, 3),
  ('Me gusta agregar trozos de pollo a mi ensalada césar', 2, 3);





CREATE TABLE recetas_favoritas (
  id_receta_favorita INT PRIMARY KEY AUTO_INCREMENT,
  id_receta INT,
  id_usuario INT,
  FOREIGN KEY (id_receta) REFERENCES recetas(id),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

INSERT INTO recetas_favoritas (id_receta, id_usuario) VALUES
  (1, 1),
  (2, 1),
  (3, 2),
  (1, 3),
  (2, 4);


