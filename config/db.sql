DROP DATABASE IF EXISTS my_vaccine;
CREATE DATABASE my_vaccine;
USE my_vaccine;

-- Tabela de usuários

CREATE TABLE users (
    cpf VARCHAR(14) PRIMARY KEY,
    role ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario',
    name VARCHAR(100) NOT NULL,
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
    contraindications TEXT, 
    date_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de estoque de vacinas por posto

CREATE TABLE stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL, -- Posto de vacinação
    vaccine_id INT NOT NULL, -- Vacina armazenada
    quantity INT NOT NULL DEFAULT 0, -- Quantidade disponível
    batch VARCHAR(50) NOT NULL, -- Lote da vacina
    expiration_date DATE NOT NULL, -- Data de validade da vacina
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Última atualização do estoque
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(id) ON DELETE CASCADE
);

-- Tabela de histórico de vacinação

CREATE TABLE vaccination_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_cpf VARCHAR(14) NOT NULL, -- CPF do usuário (paciente) que recebeu a vacina
    vaccine_id INT NOT NULL, -- Vacina aplicada
    post_id INT NOT NULL, -- Posto onde foi aplicada a vacina
    batch VARCHAR(50) NOT NULL, -- Lote da vacina aplicada
    application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Data da aplicação
    FOREIGN KEY (user_cpf) REFERENCES users(cpf) ON DELETE CASCADE, -- Paciente
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(id) ON DELETE CASCADE, -- Id da vacina
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE -- Id do posto
);

-- Inserção de 10 tipos de vacina (opcional)

INSERT INTO vaccines (name, min_age, max_age, contraindications) VALUES
('Vacina contra a COVID-19', 18, NULL, 'Alergia grave a componentes da vacina'),
('Vacina contra a Gripe', 6, NULL, 'Alergia a ovo ou componentes da vacina'),
('Vacina contra o Sarampo', 12, 59, 'Gravidez, imunossupressão'),
('Vacina contra a Hepatite B', 0, NULL, 'Alergia a levedura'),
('Vacina contra a Poliomielite', 2, NULL, 'Alergia a neomicina ou estreptomicina'),
('Vacina contra o Tétano', 7, NULL, 'Reação alérgica grave a dose anterior'),
('Vacina contra a Febre Amarela', 9, 60, 'Alergia a ovo, imunossupressão'),
('Vacina contra a HPV', 9, 26, 'Gravidez, alergia a componentes da vacina'),
('Vacina contra a Meningite', 2, 55, 'Alergia a componentes da vacina'),
('Vacina contra a Raiva', 0, NULL, 'Alergia a componentes da vacina');

-- Inserção de 10 postos (opcional)

INSERT INTO posts (name, address, city, state) VALUES
('Posto Saúde Central', 'Rua Principal, 123', 'São Paulo', 'SP'),
('Posto Saúde Norte', 'Avenida das Flores, 456', 'Rio de Janeiro', 'RJ'),
('Posto Saúde Sul', 'Rua das Palmeiras, 789', 'Porto Alegre', 'RS'),
('Posto Saúde Leste', 'Avenida Central, 321', 'Belo Horizonte', 'MG'),
('Posto Saúde Oeste', 'Rua das Árvores, 654', 'Curitiba', 'PR'),
('Posto Saúde Centro', 'Avenida do Sol, 987', 'Salvador', 'BA'),
('Posto Saúde Jardins', 'Rua das Rosas, 135', 'Brasília', 'DF'),
('Posto Saúde Beira-Mar', 'Avenida Beira-Mar, 246', 'Fortaleza', 'CE'),
('Posto Saúde Praia', 'Rua da Praia, 864', 'Recife', 'PE'),
('Posto Saúde Montanha', 'Avenida das Montanhas, 753', 'Manaus', 'AM');