-- DATABASE
DROP DATABASE IF EXISTS DB_Ambiente;
CREATE DATABASE IF NOT EXISTS DB_Ambiente;
USE DB_Ambiente;

-- TABELAS
DROP TABLE IF EXISTS TB_Usuario;
DROP TABLE IF EXISTS TB_Notificacao;
DROP TABLE IF EXISTS TB_Evento;
DROP TABLE IF EXISTS TB_Historico;
DROP TABLE IF EXISTS TB_Noticia;

CREATE TABLE TB_Usuario (
ID_Usuario int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Nm_Usuario varchar(60) NOT NULL,
Ds_Senha varchar(50) NOT NULL,
Tp_Usuario varchar(15) NOT NULL,
Ft_Usuario varchar(200) NOT NULL,
Nr_Cpf char(14) NOT NULL,
Dt_Nascimento date NOT NULL,
St_Usuario varchar(15) NOT NULL
);

CREATE TABLE TB_Notificacao (
ID_Notificacao int NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_Usuario int NOT NULL,
Nm_Bairro varchar(50) NOT NULL,
Nm_Rua varchar(50) NOT NULL,
Dt_Notificacao date NOT NULL,
Ds_PontoProximo varchar(50) NOT NULL,
Ft_Notificacao varchar(200) NOT NULL,
Ds_Notificacao varchar(100) NOT NULL,
St_Notificacao varchar(15) NOT NULL
);
ALTER TABLE TB_Notificacao
ADD CONSTRAINT FK_Notificacao_Usuario
FOREIGN KEY(ID_Usuario) REFERENCES TB_Usuario (ID_Usuario);

CREATE TABLE TB_Evento (
ID_Evento int NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_Usuario int NOT NULL,
Nm_Evento varchar(100) NOT NULL,
Dt_Evento date NOT NULL,
Hr_Evento varchar(10) NOT NULL,
Nm_Local varchar(60) NOT NULL,
Ds_Evento varchar(200) NOT NULL,
St_Evento varchar(15) NOT NULL
);
ALTER TABLE TB_Evento
ADD CONSTRAINT FK_Evento_Usuario
FOREIGN KEY(ID_Usuario) REFERENCES TB_Usuario (ID_Usuario);

CREATE TABLE TB_Historico (
ID_Historico int NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_Notificacao int NOT NULL,
Dt_Historico date NOT NULL,
Hr_Historico varchar(6) NOT NULL,
Ds_Observacao varchar(200)
);
ALTER TABLE TB_Historico
ADD CONSTRAINT FK_Historico_Notificacao
FOREIGN KEY(ID_Notificacao) REFERENCES TB_Notificacao (ID_Notificacao);

CREATE TABLE TB_Noticia (
ID_Noticia int NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_Usuario int NOT NULL,
Nm_Noticia varchar(70) NOT NULL,
Ds_Noticia varchar(300) NOT NULL,
Dt_Noticia date NOT NULL,
Hr_Noticia varchar(6) NOT NULL
);
ALTER TABLE TB_Noticia
ADD CONSTRAINT FK_Noticia_Usuario
FOREIGN KEY(ID_Usuario) REFERENCES TB_Usuario (ID_Usuario);

INSERT INTO TB_Usuario(ID_Usuario, Nm_Usuario, Ds_Senha, Tp_Usuario, Ft_Usuario, Nr_Cpf, Dt_Nascimento, St_Usuario)
VALUES(1,'jabes bueno',sha1('12345678'),'ADMINISTRADOR','../resources/img//1foto','111.111.111-11','1999-03-11','ATIVO');
