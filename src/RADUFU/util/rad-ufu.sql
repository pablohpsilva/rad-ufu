CREATE DATABASE RADUFU;

ALTER DATABASE RADUFU SET datestyle TO "ISO, DMY";

DROP TABLE IF EXISTS comprovante, atividade, multiplicador, tipo, categoria, professor;

CREATE TABLE professor(
	professor_id		SERIAL NOT NULL,
	professor_nome 		VARCHAR(60) NOT NULL,
	professor_siape		VARCHAR(30) NOT NULL,
	professor_senha		VARCHAR(40) NOT NULL,
	UNIQUE(professor_siape),
	CONSTRAINT const_professor_primary PRIMARY KEY(professor_id)
);

CREATE TABLE categoria(
	categoria_id	SERIAL NOT NULL,
	categoria_nome 	VARCHAR(30),
	UNIQUE(categoria_nome),
	CONSTRAINT const_categoria_primary PRIMARY KEY(categoria_id)
);

CREATE TABLE multiplicador(
	multiplicador_id 		SERIAL NOT NULL,
	multiplicador_nome 		VARCHAR (30),
	UNIQUE(multiplicador_nome),
	CONSTRAINT const_multiplicador_primary PRIMARY KEY(multiplicador_id)
);

CREATE TABLE tipo(
	tipo_id serial 			NOT NULL,
	tipo_categoria 			INTEGER NOT NULL,
	tipo_descricao 			VARCHAR(750) NOT NULL,
	tipo_pontuacao 			SMALLINT NOT NULL,
	tipo_pontuacaoreferencia 	FLOAT,
	tipo_pontuacaolimite 		SMALLINT,
	tipo_multiplicador 		INTEGER NOT NULL,
	CONSTRAINT const_tipo_primary PRIMARY KEY (tipo_id ),
	CONSTRAINT const_tipo_foreign FOREIGN KEY (tipo_categoria) REFERENCES categoria (categoria_id) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT const_tipo_mult_foreign FOREIGN KEY (tipo_multiplicador) REFERENCES multiplicador (multiplicador_id) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE atividade(
	atividade_id SERIAl NOT NULL,
	atividade_tipo INTEGER NOT NULL,
	atividade_descricao VARCHAR(500) NOT NULL,
	atividade_datainicio DATE,
	atividade_datafim DATE,
	atividade_multiplicador_valor REAL,
	atividade_professor INTEGER NOT NULL,
	CONSTRAINT const_atividade_primary PRIMARY KEY (atividade_id),
	CONSTRAINT const_atividade_foreign1 FOREIGN KEY (atividade_tipo) REFERENCES tipo (tipo_id) MATCH SIMPLE
   	ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT const_atividade_foreign2 FOREIGN KEY (atividade_professor) REFERENCES professor (professor_id) MATCH SIMPLE
	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE comprovante(
	comprovante_id SERIAL NOT NULL,
	comprovante_arquivo VARCHAR(500),
	comprovante_atividade INTEGER NOT NULL,
	CONSTRAINT const_comprovante_primary PRIMARY KEY (comprovante_id),
	CONSTRAINT const_comprovante_foreign FOREIGN KEY (comprovante_atividade) REFERENCES atividade (atividade_id) MATCH SIMPLE
	ON UPDATE CASCADE ON DELETE CASCADE
);
