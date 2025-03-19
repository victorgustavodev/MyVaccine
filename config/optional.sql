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
