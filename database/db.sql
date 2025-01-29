CREATE DATABASE my_vaccine;

USE my_vaccine;

-- Tabela de clientes
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID gerado aut.
    name VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,  -- CPF com até 14 caracteres, incluindo formatação
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dob DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    date_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- data de criação * gerado aut.
);


-- Tabela de administradores
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- data de criação * gerado aut.
);

-- Tabela de vacinas
CREATE TABLE vaccines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL CHECK (quantity >= 0),
    min_age INT NOT NULL,
    max_age INT NOT NULL,
    date_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT, -- ID do administrador que criou a vacina * gerado aut.
    updated_by INT, -- ID do administrador que atualizou a vacina
    FOREIGN KEY (created_by) REFERENCES admin(id),
    FOREIGN KEY (updated_by) REFERENCES admin(id)
);

-- Índice na tabela de vacinas
-- CREATE INDEX idx_vaccines_name ON vaccines (name);
