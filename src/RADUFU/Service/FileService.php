<?php
namespace RADUFU\Service;

use RADUFU\DAO\Exception,
	RADUFU\Model\Comprovante;

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
		$profDir = $root.$idProfessor."/";
		$finalDir = $profDir.$idAtividade . "/";
		$lastMile = $finalDir.$comprovante->separaNome();

		$old = \umask();
		
		if (!is_dir($root))
			\mkdir($root,0777);

		if (!is_dir($profDir))
			\mkdir($profDir,0777);

		if (!is_dir($finalDir))
			\mkdir($finalDir,0777);

		$res = move_uploaded_file($comprovante->separaCaminho(),$lastMile);
		$comprovante->setArquivo($lastMile);

		\umask($old);

		if(!$res)
			throw new Exception("Arquivo nao foi salvo:\t");
	}

	public static function remove(Comprovante $comprovante){
		//if(file_exists($comprovante->getArquivo()))
		if (is_writable($comprovante->getArquivo()))
			unlink($comprovante->getArquivo());
		/*
			$res = unlink($comprovante->getArquivo());
		if(!$res)
			throw new Exception("Arquivo nao foi apagado:\t");
		*/
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