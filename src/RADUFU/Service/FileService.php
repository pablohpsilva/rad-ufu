<?php
namespace RADUFU\Service;

use RADUFU\DAO\Exception,
	RADUFU\Model\Comprovante;

require_once (__DIR__ . '/../Autoloader.php');

class FileService{
	private function __construct(){ }

	public static function getPath(){
		$defaultPath = "/home/rad/comprovantes";
		return $defaultPath;
	}

	public static function save($idProfessor, $idAtividade, Comprovante $comprovante){
		$root = self::getPath();
		$profDir = $root.$idProfessor."/";
		$finalDir = $profDir.$idAtividade . "/";
		$lastMile = $finalDir.$comprovante->separaNome();

		if (!is_dir($root))
			\mkdir($root,0776);

		if (!is_dir($profDir))
			\mkdir($profDir,0776);

		if (!is_dir($finalDir))
			\mkdir($finalDir,0776);

		\chmod($comprovante->separaCaminho(), 0776);

		$res = move_uploaded_file($comprovante->separaCaminho(),$lastMile);
		$comprovante->setArquivo($lastMile);

		\chmod($comprovante->getArquivo(), 0776);

		if(!$res)
			throw new Exception("Arquivo nao foi salvo:\t");

		return $lastMile;
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

	public static function createDownload($pathToFile){
		$comp = new Comprovante();
		$comp->setArquivo($pathToFile);
        $fHandle = fopen($comp->getArquivo(),'rb');
        $body = fread($fHandle, filesize($comp->getArquivo()));
        fclose($fHandle);

        $headers = array(
            'Content-Description' => 'File Transfer',
            'Content-type' => 'application/'.$comp->separaExtensao(),
            'Content-Disposition' => 'attachment; filename=' .$comp->separaNome(),
            'Content-Length' => filesize($comp->getArquivo()),
            'Content-Transfer-Encoding' => ' binary',
            'Expires' => ' 0',
            'Cache-Control' => ' must-revalidate, post-check=0, pre-check=0',
            'Pragma' => ' public'
            );

        $headersBody = array(
        	"body" => $body,
        	"headers" => $headers
        	);

        return $headersBody;

	}
}
?>