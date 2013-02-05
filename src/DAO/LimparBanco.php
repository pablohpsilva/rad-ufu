<?php

require_once(__DIR__ . '/Connection.php');

class LimparBanco{
	const prof = "CREATE TABLE professor( professor_id BIGINT NOT NULL, professor_ativo BOOLEAN DEFAULT TRUE, professor_nome  VARCHAR(30) NOT NULL, professor_sobrenome VARCHAR(30) NOT NULL, professor_usuario VARCHAR(15) NOT NULL, professor_senha VARCHAR(40) NOT NULL, UNIQUE(professor_usuario), CONSTRAINT const_professor_primary PRIMARY KEY(professor_id));";
	const cate = "CREATE TABLE categoria( categoria_id	SERIAL NOT NULL, categoria_nome VARCHAR(30), CONSTRAINT const_categoria_primary PRIMARY KEY(categoria_id));";
	const tipo = "CREATE TABLE tipo(tipo_id SERIAL NOT NULL, tipo_categoria INTEGER NOT NULL, tipo_descricao VARCHAR(255) NOT NULL, tipo_pontuacao SMALLINT, tipo_pontuacaoreferencia SMALLINT, tipo_pontuacaolimite SMALLINT, CONSTRAINT const_tipo_primary PRIMARY KEY(tipo_id), CONSTRAINT const_tipo_foreign FOREIGN KEY (tipo_categoria) REFERENCES categoria(categoria_id));";
	const mult = "CREATE TABLE multiplicador(multiplicador_id SERIAL NOT NULL,multiplicador_nome VARCHAR (30),multiplicador_valor SMALLINT,multiplicador_limite SMALLINT, multiplicador_tipo_atividade INTEGER NOT NULL,CONSTRAINT const_multiplicador_primary PRIMARY KEY(multiplicador_id),CONSTRAINT const_multiplicador_foreign FOREIGN KEY (multiplicador_tipo_atividade) REFERENCES tipo(tipo_id)ON UPDATE CASCADE ON DELETE CASCADE);";
	const ativ = "CREATE TABLE atividade(atividade_id  SERIAL NOT NULL,atividade_tipo INTEGER NOT NULL,atividade_descricao  VARCHAR(255) NOT NULL,atividade_datainicio  DATE,atividade_datafim  DATE,atividade_professor BIGINT NOT NULL,CONSTRAINT const_atividade_primary PRIMARY KEY(atividade_id),CONSTRAINT const_atividade_foreign1 FOREIGN KEY (atividade_tipo) REFERENCES tipo(tipo_id),CONSTRAINT const_atividade_foreign2 FOREIGN KEY (atividade_professor) REFERENCES professor(professor_id));";
	const comp = "CREATE TABLE comprovante(comprovante_id SERIAL NOT NULL,comprovante_arquivo VARCHAR(300),comprovante_atividade INTEGER NOT NULL,CONSTRAINT const_comprovante_primary PRIMARY KEY(comprovante_id),CONSTRAINT const_comprovante_foreign FOREIGN KEY(comprovante_atividade) REFERENCES atividade(atividade_id));";


	const del = "DROP TABLE IF EXISTS comprovante, atividade, multiplicador, tipo, categoria, professor;";

	public static function limpar(){
		echo "########################<br/>";
		echo "###### LimparBanco v1.0 ######<br/>";
		echo "####### Limpando tudo! #######<br/>";
		echo "########################<br/>";

		$stm = Connection::Instance()->get()->prepare(self::del);
		$stm->execute();
		

		$stm = Connection::Instance()->get()->prepare(self::prof);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::cate);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::tipo);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::mult);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::ativ);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::comp);
		$stm->execute();

		echo "LimparBanco says: Feito! Banco novinho em folha. Aproveite! <br/><br/><br/>";
	}
}
?>