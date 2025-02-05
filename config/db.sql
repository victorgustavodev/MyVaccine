CREATE DATABASE my_vaccine;

USE my_vaccine;

-- Tabela de clientes
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario',
    name VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dob DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    date_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de postos de vacinação
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(3) NOT NULL,
);

CREATE TABLE vaccines (
    id INT AUTO_INCREMENT PRIMARY KEY, -- id
    name VARCHAR(100) NOT NULL, -- nome da vacina
    min_age INT NOT NULL, -- idade minima
    max_age INT DEFAULT NULL, -- idaded maxima
    validate DATE NOT NULL, -- validade
    contraindications TEXT, -- contraindicacoes
    created_by INT NOT NULL, -- Admin que criou a vacina
    updated_by INT, -- Admin que atualizou a vacina
    date_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- data de criação
);