CREATE DATABASE my_vaccine;
USE my_vaccine;

-- Tabela de usuários
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
    state VARCHAR(2) NOT NULL
);

-- Tabela de vacinas
CREATE TABLE vaccines (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(100) NOT NULL, 
    min_age INT NOT NULL, 
    max_age INT DEFAULT NULL, 
    validate DATE NOT NULL, 
    contraindications TEXT, 
    date_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de estoque de vacinas por posto
CREATE TABLE stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL, -- Posto de vacinação
    vaccine_id INT NOT NULL, -- Vacina armazenada
    quantity INT NOT NULL DEFAULT 0, -- Quantidade disponível
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Última atualização do estoque
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(id) ON DELETE CASCADE
);
