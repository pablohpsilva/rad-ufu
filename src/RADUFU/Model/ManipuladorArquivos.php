<?php
class ManipuladorArquivos{
	private static $caminho = "/var/www/rad-ufu/dump/";

	# Recebe um arquivo tipo MeuRelatorio.pdf. Muda o nome dele para algo mais elaborado.
	# Sera usada para armazenamento de arquivos unicos.
	public static function rename($input,$idProfessor,$data,$categoria){
		$aux = split(".pdf", $input);
		$newName = $idProfessor . "-" . $data . "-" . $categoria . "-" . $aux[0];
		unset($aux);
		return $newName;
	}

	# Salvara o arquivo em disco.
	# Criara um novo nome para o mesmo
	# Renomeara o nome do arquivo para o novo nome.
	# Retornara o novo nome usado.
	public static function create($input,$idProfessor,$data,$categoria){
		$aux = rename($input,$idProfessor,$data,$categoria);
		//self::$caminho;
		return $aux;
	}

	# Excluira o arquivo selecionado.
	public static function delete($input){
		#
	}

	# Mudara o arquivo de um lugar para outro.
	public static function move($input,$oldPlace,$newPlace){
		#
	}
}
?>