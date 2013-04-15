<?php
namespace RADUFU\Service;

use RADUFU\DAO\Exception,
	RADUFU\Model\Comprovante;

require_once (__DIR__ . '/../Autoloader.php');

class FileService{
	private function __construct(){ }

	public static function getPath(){
		$defaultPath = __DIR__."/../../../../FileService/";
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

	private static function readfile_chunked($filename) { 
		\chmod($filename, 0777);
        $chunksize = 1*(1024*1024);
        $buffer = ''; 
        $handle = fopen($filename, 'rb');
        echo $handle;

        if ($handle === false)
            return false;

        while (!feof($handle)) { 
            $buffer = fread($handle, $chunksize); 
            print $buffer; 
        }

        return fclose($handle); 
    }

    public static function downloadFile($filePath,$fileName,$fileExt){
        header('Content-Description: File Transfer');
        header('Content-type: application/'.$fileExt);
        header('Content-Disposition: attachment; filename=' .$fileName);
        header('Content-Length: '.filesize($filePath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');

        self::readfile_chunked($filePath);

        \chmod($filePath, 0776);
    }
}
?>