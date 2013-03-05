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
		$defaultPath = __DIR__."/../../../../FileService/";
		return $defaultPath;
	}

	public static function save($idProfessor, $idAtividade, Comprovante $comprovante){
		$root = self::getPath();
		$profDir = $caminho.$idProfessor."/";
		$finalDir = $profDir.$idAtividade . "/";
		$lastMile = $destino.$comprovante->separaNome();

		if (!is_dir($caminho))
			mkdir($caminho);

		if (!is_dir($profDir))
			mkdir($profDir);

		if (!is_dir($destino))
			mkdir($destino);

		$res = move_uploaded_file($comprovante->separaCaminho(),$lastMile);

		if(!$res)
			throw new Exception("Arquivo nao foi salvo:\t");
	}

	public static function remove(Comprovante $comprovante){
		$res = unlink($comprovante->getArquivo());
		if(!$res)
			throw new Exception("Arquivo nao foi apagado:\t");
	}

	public static function move(Comprovante $oldComp, Comprovante $newComp){
		self::remove($oldComp);
		$aux = explode("/",$oldComp->getArquivo());
		$size = sizeof($aux);
		$idProfessor = $aux[$aux-2];
		$idAtividade = $aux[$aux-1];
		self::save($idProfessor,$idAtividade,$newComp);
	}

}
?>