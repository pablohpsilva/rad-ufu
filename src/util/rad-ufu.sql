CREATE DATABASE RADUFU;

CREATE TABLE categoria(
	categoria_nome 	varchar(30) PRIMARY KEY
);

CREATE TABLE multiplicador(
	multiplicador_id 		serial PRIMARY KEY,
	multiplicador_nome 		varchar (30),
	multiplicador_valor 		smallint,
	multiplicador_limite		smallint
	multiplicador_tipo_atividade    int,
	FOREIGN KEY (multiplicador_tipo_atividade) REFERENCES tipo(tipo_codigo)
	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE tipo(
	tipo_codigo 			serial PRIMARY KEY,
	tipo_categoria 			int,
	tipo_descricao 			varchar(255),
	tipo_pontuacao 			smallint,
	tipo_pontuacaoreferencia	smallint,
	tipo_pontuacaolimite 		smallint,
	FOREIGN KEY (tipo_categoria) REFERENCES categoria(categoria_nome)
	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE atividade(
	atividade_id		serial PRIMARY KEY,
	atividade_tipo		int NOT NULL,
	atividade_descricao 	varchar(255) NOT NULL,
	atividade_datainicio 	date,
	atividade_datafim 	date,
	atividade_professor	bigint NOT NULL,
	FOREIGN KEY (atividade_tipo) REFERENCES tipo(tipo_codigo),
	FOREIGN KEY (atividade_professor) REFERENCES professor(professor_siape),
);

CREATE TABLE comprovante(
	comprovante_arquivo 	varchar(300) PRIMARY KEY,
	comprovante_atividade 	integer,
	FOREIGN KEY (comprovante_atividade) REFERENCES atividade(atividade_id)
);

CREATE TABLE professor(
	professor_siape		bigint PRIMARY KEY,
	professor_ativo		smallint,
	professor_nome 		varchar(30) NOT NULL,
	professor_sobrenome	varchar(30) NOT NULL,
	professor_usuario	varchar(15) NOT NULL,
	professor_senha		varchar(40) NOT NULL,
	UNIQUE(professor_usuario)
	ON DELETE CASCADE
);