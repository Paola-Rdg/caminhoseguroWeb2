DROP DATABASE IF EXISTS caminho_seguro;
CREATE DATABASE caminho_seguro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE caminho_seguro;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    data_nascimento DATE NOT NULL,
    perfil_interesse VARCHAR(30) NOT NULL,
    tipo_usuario VARCHAR(20) NOT NULL DEFAULT 'comum'
);

CREATE TABLE conteudo (
    id_conteudo INT AUTO_INCREMENT PRIMARY KEY,
    textos TEXT NOT NULL,
    infograficos VARCHAR(255),
    videos VARCHAR(255),
    palavras_chave VARCHAR(150) NOT NULL,
    perfil_associado VARCHAR(30) NOT NULL
);

CREATE TABLE quiz (
    id_quiz INT AUTO_INCREMENT PRIMARY KEY,
    quant_perguntas INT NOT NULL,
    nivel_dificuldade INT NOT NULL,
    pontuacao_total FLOAT NOT NULL,
    perfil_associado VARCHAR(30) NOT NULL,
    id_usuario INT NOT NULL,
    CONSTRAINT fk_quiz_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE perguntas_quiz (
    id_pergunta INT AUTO_INCREMENT PRIMARY KEY,
    texto_pergunta VARCHAR(255) NOT NULL,
    pontuacao FLOAT NOT NULL,
    explicacao VARCHAR(255) NOT NULL,
    id_quiz INT NOT NULL,
    CONSTRAINT fk_pergunta_quiz FOREIGN KEY (id_quiz) REFERENCES quiz(id_quiz) ON DELETE CASCADE
);

CREATE TABLE alternativas (
    id_alternativa INT AUTO_INCREMENT PRIMARY KEY,
    texto_alternativa VARCHAR(255) NOT NULL,
    status_alternativa BOOLEAN NOT NULL,
    explicacao_altern VARCHAR(255) NOT NULL,
    id_pergunta INT NOT NULL,
    CONSTRAINT fk_alternativa_pergunta FOREIGN KEY (id_pergunta) REFERENCES perguntas_quiz(id_pergunta) ON DELETE CASCADE
);

CREATE TABLE resultado_quiz (
    id_resultado INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_quiz INT NOT NULL,
    pontuacao_obtida FLOAT NOT NULL,
    data_realizacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_res_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    CONSTRAINT fk_res_quiz FOREIGN KEY (id_quiz) REFERENCES quiz(id_quiz) ON DELETE CASCADE
);

-- Contas iniciais (Senha de ambas: 123456 em MD5 - RNF003)
INSERT INTO usuario (nome, email, senha, cpf, data_nascimento, perfil_interesse, tipo_usuario) VALUES
('Administrador Caminho Seguro', 'admin@caminhoseguro.com', MD5('123456'), '00000000000', '2000-01-01', 'Motorista', 'admin'),
('Estudante Exemplo', 'aluno@caminhoseguro.com', MD5('123456'), '11111111111', '2009-04-15', 'Pedestre', 'comum');

INSERT INTO conteudo (textos, infograficos, videos, palavras_chave, perfil_associado) VALUES
('Conforme o Art. 69 do CTB, para cruzar a pista de rolamento o pedestre deve tomar precauções de segurança, observando a visibilidade, a distância e a velocidade dos veículos, utilizando sempre as faixas ou passagens destinadas a ele sempre que existirem a uma distância de até 50 metros.', 'https://www.gov.br/transportes/pt-br', 'https://www.youtube.com/watch?v=9bZkp7q19f0', 'faixa de pedestres, travessia, art 69, semaforo', 'Pedestre'),
('De acordo com o Art. 58 do CTB, nas vias urbanas e nas rurais de pista dupla, a circulação de bicicletas deve ocorrer, quando não houver ciclovia ou ciclofaixa, nos bordos da pista de rolamento, no mesmo sentido de circulação regulamentado para a via, com preferência sobre os veículos automotores.', '', '', 'bicicleta, ciclovia, bordo da pista, art 58', 'Ciclista'),
('Segundo o Art. 201 do CTB, deixar de guardar a distância lateral de um metro e cinquenta centímetros (1,50m) ao passar ou ultrapassar bicicleta configura infração média. Além disso, o Art. 38 exige atenção redobrada em rotatórias e conversões.', '', '', 'distancia lateral, ciclista, rotatoria, art 201', 'Motorista');

INSERT INTO quiz (quant_perguntas, nivel_dificuldade, pontuacao_total, perfil_associado, id_usuario) VALUES
(2, 1, 10.0, 'Pedestre', 1),
(1, 2, 10.0, 'Ciclista', 1);

INSERT INTO perguntas_quiz (texto_pergunta, pontuacao, explicacao, id_quiz) VALUES
('Quando existe uma faixa de pedestres a menos de 50 metros, o que determina o Art. 69 do CTB?', 5.0, 'O Art. 69 do CTB estabelece que o pedestre é obrigado a utilizar a faixa ou passagem destinada a ele sempre que estiver a até 50 metros.', 1),
('Em uma faixa de pedestres sem semáforo, quem possui preferência de passagem segundo o Art. 70 do CTB?', 5.0, 'Os pedestres que já estiverem atravessando a via sobre as faixas delimitadas têm prioridade de passagem, devendo os veículos parar.', 1),
('Em uma rua sem ciclovia ou ciclofaixa, como o ciclista deve circular segundo o Art. 58 do CTB?', 10.0, 'A bicicleta deve circular nos bordos da pista de rolamento e no mesmo sentido de circulação dos veículos.', 2);

INSERT INTO alternativas (texto_alternativa, status_alternativa, explicacao_altern, id_pergunta) VALUES
('Atravessar em qualquer ponto da rua se não houver carros próximos.', 0, 'Incorreto: atravessar fora da faixa estando a menos de 50m dela contraria o Art. 69.', 1),
('Caminhar até a faixa de pedestres e atravessar com atenção.', 1, 'Correto! Garante maior visibilidade e segurança jurídica prevista no CTB.', 1),
('O pedestre que já iniciou a travessia sobre a faixa.', 1, 'Correto! O Art. 70 assegura prioridade absoluta ao pedestre na faixa não semaforizada.', 2),
('O automóvel que estiver trafegando na via principal.', 0, 'Incorreto: os condutores devem reduzir a velocidade e ceder passagem ao pedestre.', 2),
('No bordo da pista, no mesmo sentido dos carros.', 1, 'Correto! Facilita a visibilidade pelos motoristas e segue o fluxo da via.', 3),
('Na contramão, próximo ao meio-fio.', 0, 'Incorreto: circular na contramão aumenta o risco de colisão frontal.', 3);