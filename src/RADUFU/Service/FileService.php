<?php
namespace RADUFU\Service;

use RADUFU\DAO\Exception;

class FileService{
	private function __construct(){ }

	/*
	 *$file = $_FILES['file']
	 *@type: FILE
	 */
	public static function getPath(){
		$caminho = __DIR__."/../../../../FileService/";
		return $caminho;
	}

	public static function saveFile($idProfessor, $idAtividade, $arquivo){
		$caminho = self::getPath();

		if (!is_dir($caminho)){ mkdir($caminho); } 
		if (!is_dir($caminho.$idProfessor."/")){ mkdir($caminho.$idProfessor."/"); } 
		
		$destino = $caminho.$idProfessor."/".$idAtividade."/";
		
		if (!is_dir($destino)){ mkdir($destino); }
		$destino = $destino."/".$arquivo['name'];

		$res = move_uploaded_file($arquivo['tmp_name'],$destino);

		if(!$res)
			throw new Exception("Arquivo nao foi salvo:\t");
        else
        	return $res;
	}

	public static function removeFile($fileName){
		$res = unlink($fileName);
		if(!$res)
			throw new Exception("Arquivo nao foi apagado:\t");
		else
			return $res;
	}

	public static function moveFile($fileName,$newPath){
		$aux = explode("/", $fileName);
		$last = sizeof($aux);
		if(copy($fileName, $newPath . $aux[$last-1]))
			if(self::removeFile($fileName))
				return $newPath.$aux[$last-1];
		else
			return FALSE;
	}

}
?>