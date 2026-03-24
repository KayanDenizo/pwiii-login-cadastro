CREATE DATABASE  etimUsuario;

USE etimUsuario;
CREATE TABLE usuario(
    id int PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (255) not null,
    email VARCHAR(255) not null unique,
    senha VARCHAR (255) not null
);