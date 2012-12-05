CREATE DATABASE RADUFU;

CREATE TABLE categoria(
	categoria_id 	serial PRIMARY KEY,
	categoria_nome 	varchar(30)
);

CREATE TABLE multiplicador(
	multiplicador_id 		serial PRIMARY KEY,
	multiplicador_nome 		varchar (30),
	multiplicador_valor 	smallint,
	multiplicador_limite	smallint
	multiplicador_tipo_atividade    int,
	FOREIGN KEY (multiplicador_tipo_atividade) REFERENCES tipo(tipo_codigo)
	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE tipo(
	tipo_codigo 				serial PRIMARY KEY,
	tipo_categoria 				int,
	tipo_descricao 				varchar(255),
	tipo_pontuacao 				smallint,
	tipo_pontuacaoreferencia 	smallint,
	tipo_pontuacaolimite 		smallint,
	FOREIGN KEY (tipo_categoria) REFERENCES categoria(categoria_id)
	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE atividade(
	atividade_id			serial PRIMARY KEY,
	atividade_tipo			int,
	atividade_descricao 	varchar(255),
	atividade_datainicio 	date,
	atividade_datafim 		date,
	atividade_professor		integer,
	FOREIGN KEY (atividade_tipo) REFERENCES tipo(tipo_codigo),
	FOREIGN KEY (atividade_professor) REFERENCES tipo(professor_id)
	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE comprovante(
	comprovante_id 			serial PRIMARY KEY,
	comprovante_arquivo 	varchar(300),
	comprovante_atividade 	integer,
	FOREIGN KEY (comprovante_atividade) REFERENCES atividade(atividade_id)
	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE professor(
	professor_id 		serial PRIMARY KEY,
	professor_nome 		varchar(30),
	professor_sobrenome	varchar(30),
	professor_usuario	varchar(15),
	professor_senha		varchar(40),
	professor_siape		integer
);