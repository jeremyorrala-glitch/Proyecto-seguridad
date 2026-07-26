-- Base de datos del Sistema Transaccional
-- Proyecto Final - Buenas practicas de seguridad web

CREATE DATABASE IF NOT EXISTS proyecto_seguridad;
USE proyecto_seguridad;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    celular VARCHAR(15) NOT NULL,
    intentos_fallidos INT DEFAULT 0,
    bloqueado_hasta DATETIME NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuario de prueba
-- IMPORTANTE: esta contraseña se inserta ya con hash bcrypt (ver registro.php version final)
-- password de prueba: Cl@ve#2026
INSERT INTO usuarios (nombre_usuario, password, celular) VALUES
('jeremy', '$2y$10$examplehasheddummyvaluefortestingonly1234567890abcd', '0991234567');
