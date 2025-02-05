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

-- Tabela de vacinas
-- CREATE TABLE vaccines (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(100) NOT NULL,
--     min_age INT NOT NULL,
--     max_age INT NOT NULL,
--     created_by INT NOT NULL, -- Admin que criou a vacina
--     updated_by INT,          -- Admin que atualizou a vacina
--     date_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
-- );
