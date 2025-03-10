-- Inserção de vacinas

USE my_vaccine;

INSERT INTO vaccines (name, min_age, max_age, contraindications) VALUES
('Vacina contra a COVID-19', 18, NULL, 'Alergia grave a componentes da vacina'),
('Vacina contra a Gripe', 6, NULL, 'Alergia a ovo ou componentes da vacina'),
('Vacina contra o Sarampo', 12, 59, 'Gravidez, imunossupressão'),
('Vacina contra a Hepatite B', 0, NULL, 'Alergia a levedura'),
('Vacina contra a Poliomielite', 2, NULL, 'Alergia a neomicina ou estreptomicina'),
('Vacina contra o Tétano', 7, NULL, 'Reação alérgica grave a dose anterior'),
('Vacina contra a Febre Amarela', 9, 60, 'Alergia a ovo, imunossupressão'),
('Vacina contra o HPV', 9, 26, 'Gravidez, alergia a componentes da vacina'),
('Vacina contra a Meningite', 2, 55, 'Alergia a componentes da vacina'),
('Vacina contra a Raiva', 0, NULL, 'Alergia a componentes da vacina'),
('Vacina contra Rotavírus', 2, 8, 'Intussuscepção prévia'),
('Vacina contra Varicela', 12, NULL, 'Gravidez, imunossupressão'),
('Vacina contra Haemophilus influenzae tipo b (Hib)', 2, 5, 'Alergia a componentes da vacina');

-- Inserindo usuários antes do histórico de vacinação
INSERT INTO users (cpf, role, name, password, email, dob, address, telephone) VALUES
('12345678901', 'usuario', 'Usuário 1', SHA2('senha1', 256), 'user1@email.com', '1990-01-01', 'Endereço 1', '81999990001'),
('98765432109', 'usuario', 'Usuário 2', SHA2('senha2', 256), 'user2@email.com', '1991-02-02', 'Endereço 2', '81999990002'),
('11223344556', 'usuario', 'Usuário 3', SHA2('senha3', 256), 'user3@email.com', '1992-03-03', 'Endereço 3', '81999990003'),
('66554433221', 'usuario', 'Usuário 4', SHA2('senha4', 256), 'user4@email.com', '1993-04-04', 'Endereço 4', '81999990004'),
('12312312312', 'usuario', 'Usuário 5', SHA2('senha5', 256), 'user5@email.com', '1994-05-05', 'Endereço 5', '81999990005'),
('32132132132', 'usuario', 'Usuário 6', SHA2('senha6', 256), 'user6@email.com', '1995-06-06', 'Endereço 6', '81999990006'),
('45645645645', 'usuario', 'Usuário 7', SHA2('senha7', 256), 'user7@email.com', '1996-07-07', 'Endereço 7', '81999990007'),
('65465465465', 'usuario', 'Usuário 8', SHA2('senha8', 256), 'user8@email.com', '1997-08-08', 'Endereço 8', '81999990008'),
('78978978978', 'usuario', 'Usuário 9', SHA2('senha9', 256), 'user9@email.com', '1998-09-09', 'Endereço 9', '81999990009'),
('98798798798', 'usuario', 'Usuário 10', SHA2('senha10', 256), 'user10@email.com', '1999-10-10', 'Endereço 10', '81999990010'),
('15915915915', 'usuario', 'Usuário 11', SHA2('senha11', 256), 'user11@email.com', '2000-11-11', 'Endereço 11', '81999990011'),
('35735735735', 'usuario', 'Usuário 12', SHA2('senha12', 256), 'user12@email.com', '2001-12-12', 'Endereço 12', '81999990012'),
('75375375375', 'usuario', 'Usuário 13', SHA2('senha13', 256), 'user13@email.com', '2002-01-13', 'Endereço 13', '81999990013');

-- Inserção de postos de saúde
INSERT INTO posts (name, address, city, state) VALUES
('Posto Saúde Central', 'Rua Principal, 123', 'São Paulo', 'SP'),
('Posto Saúde Campinas', 'Rua das Acácias, 258', 'Campinas', 'SP'),
('Posto Saúde Ribeirão Preto', 'Avenida Independência, 951', 'Ribeirão Preto', 'SP'),
('Posto Saúde Joinville', 'Rua Blumenau, 369', 'Joinville', 'SC'),
('Posto Saúde Norte', 'Avenida das Flores, 456', 'Rio de Janeiro', 'RJ'),
('Posto Saúde Sul', 'Rua das Palmeiras, 789', 'Porto Alegre', 'RS'),
('Posto Saúde Leste', 'Avenida Central, 321', 'Belo Horizonte', 'MG'),
('Posto Saúde Oeste', 'Rua das Árvores, 654', 'Curitiba', 'PR'),
('Posto Saúde Centro', 'Avenida do Sol, 987', 'Salvador', 'BA'),
('Posto Saúde Jardins', 'Rua das Rosas, 135', 'Brasília', 'DF'),
('Posto Saúde Beira-Mar', 'Avenida Beira-Mar, 246', 'Fortaleza', 'CE'),
('Posto Saúde Praia', 'Rua da Praia, 864', 'Recife', 'PE'),
('Posto Saúde Montanha', 'Avenida das Montanhas, 753', 'Manaus', 'AM');

-- Inserção de usuário admin
INSERT INTO users (cpf, role, name, password, email, dob, address, telephone) VALUES
(99999999999, 'admin', 'Administrador', SHA2('adm', 256), 'adm@adm.com', '2000-01-01', 'n/a', '81996512724');

-- Inserção de estoques
INSERT INTO stocks (post_id, vaccine_id, quantity, batch, expiration_date) VALUES
(1, 1, 100, 'COVID19-001', '2024-12-31'),
(1, 2, 150, 'GRIPE-002', '2024-11-30'),
(2, 3, 50, 'SARAMPO-003', '2025-01-15'),
(2, 4, 200, 'HEPB-004', '2024-10-31'),
(3, 5, 120, 'POLIO-005', '2025-02-28'),
(3, 6, 80, 'TETANO-006', '2024-09-30'),
(4, 7, 60, 'FEBREA-007', '2025-03-15'),
(4, 8, 90, 'HPV-008', '2024-08-31'),
(5, 9, 70, 'MENING-009', '2025-04-30'),
(5, 10, 110, 'RAIVA-010', '2024-07-31'),
(6, 11, 130, 'ROTAV-011', '2025-05-31'),
(6, 12, 160, 'VARIC-012', '2024-06-30'),
(7, 13, 140, 'HIB-013', '2025-06-30'),
(8, 1, 180, 'COVID19-014', '2024-05-31'),
(9, 2, 190, 'GRIPE-015', '2025-07-31'),
(10, 3, 170, 'SARAMPO-016', '2024-04-30');

-- Inserção de histórico de vacinação
INSERT INTO vaccination_history (user_cpf, vaccine_id, post_id, batch) VALUES
('12345678901', 1, 1, 'COVID19-001'),
('98765432109', 2, 2, 'GRIPE-002'),
('11223344556', 3, 3, 'SARAMPO-003'),
('66554433221', 4, 4, 'HEPB-004'),
('12312312312', 5, 5, 'POLIO-005'),
('32132132132', 6, 6, 'TETANO-006'),
('45645645645', 7, 7, 'FEBREA-007'),
('65465465465', 8, 8, 'HPV-008'),
('78978978978', 9, 9, 'MENING-009'),
('98798798798', 10, 10, 'RAIVA-010'),
('15915915915', 11, 6, 'ROTAV-011'),
('35735735735', 12, 1, 'VARIC-012'),
('75375375375', 13, 2, 'HIB-013');
