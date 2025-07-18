-- Base de datos para la aplicación de Turismo
CREATE DATABASE turismo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE turismo;

-- Tabla de destinos
CREATE TABLE destinos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    categoria VARCHAR(50),
    costo DECIMAL(10,2) DEFAULT 0,
    duracion INT DEFAULT 0, -- en minutos
    imagen VARCHAR(100),
    latitud DECIMAL(10,6) DEFAULT NULL,
    longitud DECIMAL(10,6) DEFAULT NULL
);

-- Tabla de recorridos (agrupaciones de destinos)
CREATE TABLE recorridos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- Relación de recorridos y destinos
CREATE TABLE recorridos_destinos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recorrido_id INT NOT NULL,
    destino_id INT NOT NULL,
    FOREIGN KEY (recorrido_id) REFERENCES recorridos(id) ON DELETE CASCADE,
    FOREIGN KEY (destino_id) REFERENCES destinos(id) ON DELETE CASCADE
);

-- Destinos de ejemplo
INSERT INTO destinos (nombre, descripcion, categoria, costo, duracion, imagen, latitud, longitud) VALUES
('Estadio \u00dAnico', 'Estadio para eventos deportivos y recitales.', 'Deportivo', 0, 90, 'estadio-unico.jpg', -27.766056, -64.273412),
('Cancha de Hockey', 'Complejo para competencias de hockey profesional.', 'Deportivo', 0, 60, 'estadiode-hockey.jpg', -27.765500, -64.274000),
('Complejo Juan Felipe Ibarra', 'Edificio emblem\u00e1tico de la provincia.', 'Cultural', 0, 45, 'las-torres.jpg', -27.797000, -64.261800),
('Plaza Libertad', 'Espacio hist\u00f3rico en el centro de la ciudad.', 'Cultural', 0, 30, 'plaza-libertad.jpg', -27.795070, -64.262000);

-- Recorridos de ejemplo
INSERT INTO recorridos (nombre, descripcion) VALUES
('Recorrido Deportivo', 'Visita a las principales infraestructuras deportivas.'),
('Recorrido Hist\u00f3rico', 'Conoce edificios y plazas relevantes.');

INSERT INTO recorridos_destinos (recorrido_id, destino_id) VALUES
(1,1), (1,2),
(2,3), (2,4);
