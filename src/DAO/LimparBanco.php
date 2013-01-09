<?php

require_once(__DIR__ . '/Connection.php');

class LimparBanco{
	const prof = "CREATE TABLE professor(
			professor_siape		bigint PRIMARY KEY,
			professor_ativo		boolean DEFAULT true,
			professor_nome 		varchar(30) NOT NULL,
			professor_sobrenome	varchar(30) NOT NULL,
			professor_usuario	varchar(15) NOT NULL,
			professor_senha		varchar(40) NOT NULL,
			UNIQUE(professor_usuario)
			);";

	const cate = "CREATE TABLE categoria(
			categoria_nome 	varchar(30) PRIMARY KEY
			);";

	const tipo = "CREATE TABLE tipo(
			tipo_codigo 			serial PRIMARY KEY,
			tipo_categoria 			varchar(30),
			tipo_descricao 			varchar(255),
			tipo_pontuacao 			smallint,
			tipo_pontuacaoreferencia	smallint,
			tipo_pontuacaolimite 		smallint,
			FOREIGN KEY (tipo_categoria) REFERENCES categoria(categoria_nome)
			);";

	const mult = "CREATE TABLE multiplicador(
			multiplicador_id 		serial PRIMARY KEY,
			multiplicador_nome 		varchar (30),
			multiplicador_valor 		smallint,
			multiplicador_limite		smallint,
			multiplicador_tipo_atividade    int,
			FOREIGN KEY (multiplicador_tipo_atividade) REFERENCES tipo(tipo_codigo)
			ON UPDATE CASCADE ON DELETE CASCADE
			);";

	const ativ = "CREATE TABLE atividade(
			atividade_id		serial PRIMARY KEY,
			atividade_tipo		int NOT NULL,
			atividade_descricao 	varchar(255) NOT NULL,
			atividade_datainicio 	date,
			atividade_datafim 	date,
			atividade_professor	bigint NOT NULL,
			FOREIGN KEY (atividade_tipo) REFERENCES tipo(tipo_codigo),
			FOREIGN KEY (atividade_professor) REFERENCES professor(professor_siape)
			);";

	const comp = "CREATE TABLE comprovante(
			comprovante_arquivo 	varchar(300) PRIMARY KEY,
			comprovante_atividade 	integer,
			FOREIGN KEY (comprovante_atividade) REFERENCES atividade(atividade_id)
			);";


	const del_prof = "drop table professor;";
	const del_cate = "drop table categoria;";
	const del_tipo = "drop table tipo;";
	const del_mult = "drop table multiplicador;";
	const del_ativ = "drop table atividade;";
	const del_comp = "drop table comprovante;";

	public static function limpar(){
		echo "########################<br/>";
		echo "###### LimparBanco v1.0 ######<br/>";
		echo "####### Limpando tudo! #######<br/>";
		echo "########################<br/>";

		$stm = Connection::Instance()->get()->prepare(self::del_comp);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::del_ativ);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::del_mult);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::del_tipo);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::del_cate);
		$stm->execute();
		$stm = Connection::Instance()->get()->prepare(self::del_prof);
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