/*
CREATE DATABASE tcc;
use tcc;

-- Criar tabela de usuário (funcionários)
CREATE TABLE usuario (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  cpf VARCHAR(45) NOT NULL,
  senha VARCHAR(45) NOT NULL,
  email VARCHAR(45) NOT NULL,
  telefone VARCHAR(45) NOT NULL,
  endereco VARCHAR(45) NOT NULL,
  cep VARCHAR(45) NOT NULL,
  rg VARCHAR(45) NOT NULL,
  registro_func VARCHAR(45) NOT NULL,
  data_efetiv VARCHAR(45) NOT NULL,
  func_status VARCHAR(45) NOT NULL,
  data_saida VARCHAR(45) NULL,
  cargo VARCHAR(45) NOT NULL,
  PRIMARY KEY (id));
  

-- Criar a tabela Clientes
CREATE TABLE Clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(15),
    email VARCHAR(100) UNIQUE,
    endereco TEXT,
    cpf VARCHAR(14) UNIQUE
);

-- Criar a tabela Quartos
CREATE TABLE Quartos (
    id_quarto INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL UNIQUE,
    tipo VARCHAR(50),
    preco_noite DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) DEFAULT 'Disponível'
);

-- Criar a tabela Reservas
CREATE TABLE Reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    id_quarto INT,
    data_checkin DATE NOT NULL,
    data_checkout DATE NOT NULL,
    total DECIMAL(10,2),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente),
    FOREIGN KEY (id_quarto) REFERENCES Quartos(id_quarto)
);

-- Criar a tabela Pagamentos
CREATE TABLE Pagamentos (
    id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT,
    metodo VARCHAR(50),
    valor DECIMAL(10,2),
    data_pagamento DATE NOT NULL,
    FOREIGN KEY (id_reserva) REFERENCES Reservas(id_reserva)
);

-- Inserir funcionário
INSERT INTO usuario(nome, cpf, senha, email, telefone, endereco, cep, rg, registro_func, data_efetiv, func_status, cargo)
values('Joao', '23748923809', 'joao1234', 'joao@gmail.com', '1234123412', 'rua jose antonio', '1231234121', '12312341234', '123456', '12/09/2013', 'trabalhando', 'fachineiro');

-- Inserir quartos
INSERT INTO Quartos (numero, tipo, preco_noite, status)
VALUES 
(101, 'Solteiro', 150.00, 'Disponível'),
(102, 'Casal', 200.00, 'Disponível'),
(103, 'Família', 300.00, 'Disponível'),
(201, 'Solteiro', 150.00, 'Disponível'),
(202, 'Casal', 200.00, 'Disponível'),
(203, 'Família', 300.00, 'Disponível');
*/