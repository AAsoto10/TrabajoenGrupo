-- Script SQL para crear la base de datos y tablas
CREATE DATABASE IF NOT EXISTS db_citas_medicas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_citas_medicas;

-- Tabla medicos
CREATE TABLE IF NOT EXISTS medicos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  especialidad VARCHAR(150) DEFAULT NULL,
  telefono VARCHAR(50) DEFAULT NULL,
  correo VARCHAR(150) DEFAULT NULL
);

-- Tabla pacientes
CREATE TABLE IF NOT EXISTS pacientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  documento VARCHAR(100) DEFAULT NULL,
  telefono VARCHAR(50) DEFAULT NULL,
  correo VARCHAR(150) DEFAULT NULL
);

-- Tabla citas
CREATE TABLE IF NOT EXISTS citas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_paciente INT NOT NULL,
  id_medico INT NOT NULL,
  fecha_cita DATE NOT NULL,
  hora_cita TIME NOT NULL,
  estado ENUM('Pendiente','Atendida','Cancelada') DEFAULT 'Pendiente',
  motivo TEXT,
  CONSTRAINT fk_cita_paciente FOREIGN KEY (id_paciente) REFERENCES pacientes(id) ON DELETE CASCADE,
  CONSTRAINT fk_cita_medico FOREIGN KEY (id_medico) REFERENCES medicos(id) ON DELETE CASCADE,
  UNIQUE KEY uk_cita_unica (id_medico, fecha_cita, hora_cita)
);

-- Datos de ejemplo
INSERT INTO medicos (nombre, especialidad, telefono, correo) VALUES
('Dr. Juan Perez', 'Cardiología', '555-1234', 'juan.perez@example.com'),
('Dra. María López', 'Pediatría', '555-5678', 'maria.lopez@example.com');

INSERT INTO pacientes (nombre, documento, telefono, correo) VALUES
('Carlos Gómez','DNI12345','555-0001','carlos.gomez@example.com'),
('Ana Ruiz','DNI67890','555-0002','ana.ruiz@example.com');
