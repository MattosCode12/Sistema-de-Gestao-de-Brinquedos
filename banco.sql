CREATE DATABASE IF NOT EXISTS crud_brinquedos;

USE crud_brinquedos;

CREATE TABLE IF NOT EXISTS brinquedos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    faixa_etaria VARCHAR(50) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade_estoque INT NOT NULL
);