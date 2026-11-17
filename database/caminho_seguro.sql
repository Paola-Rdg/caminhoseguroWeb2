CREATE DATABASE IF NOT EXISTS caminho_seguro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE caminho_seguro;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    data_nascimento DATE NOT NULL,
    perfil_interesse VARCHAR(30) NOT NULL
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
    CONSTRAINT fk_quiz_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

CREATE TABLE perguntas_quiz (
    id_pergunta INT AUTO_INCREMENT PRIMARY KEY,
    texto_pergunta VARCHAR(255) NOT NULL,
    pontuacao FLOAT NOT NULL,
    explicacao VARCHAR(255) NOT NULL,
    id_quiz INT NOT NULL,
    CONSTRAINT fk_pergunta_quiz FOREIGN KEY (id_quiz) REFERENCES quiz(id_quiz)
);

CREATE TABLE alternativas (
    id_alternativa INT AUTO_INCREMENT PRIMARY KEY,
    texto_alternativa VARCHAR(255) NOT NULL,
    status_alternativa BOOLEAN NOT NULL,
    explicacao_altern VARCHAR(255) NOT NULL,
    id_pergunta INT NOT NULL,
    CONSTRAINT fk_alternativa_pergunta FOREIGN KEY (id_pergunta) REFERENCES perguntas_quiz(id_pergunta)
);