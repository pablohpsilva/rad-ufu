<?php
namespace RADUFU\Service;

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

		if (move_uploaded_file($arquivo['tmp_name'],$destino)) { return $destino; }
		else { return -1; }
	}

	public static function removeFile($fileName){
		if(unlink($fileName))
			return TRUE;
		else
			return FALSE;
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