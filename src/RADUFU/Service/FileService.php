<?php
namespace RADUFU\Service;

use RADUFU\DAO\Exception,
	RADUFU\Model\Comprovante;

require_once (__DIR__ . '/../Autoloader.php');

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

		if (!is_dir($root))
			\mkdir($root,0776);

		if (!is_dir($profDir))
			\mkdir($profDir,0776);

		if (!is_dir($finalDir))
			\mkdir($finalDir,0776);

		\chmod($comprovante->separaCaminho(), 0776);

		$res = move_uploaded_file($comprovante->separaCaminho(),$lastMile);
		//$res = copy($comprovante->separaCaminho(), $lastMile);
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
        $chunksize = 1*(1024*1024); // how many bytes per chunk 
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
    	///*
        header('Content-Description: File Transfer');
        // We'll be outputting a MP3
        header('Content-type: application/'.$fileExt);
        // It will be called file.mp3
        header('Content-Disposition: attachment; filename=' .$fileName);
        header('Content-Length: '.filesize($filePath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        // The MP3 source is in somefile.pdf
        //readfile("somefile.mp3");
        //echo $filePath;
        //*/
        self::readfile_chunked($filePath);

        \chmod($filePath, 0776);
    }
}
####
####
#### Retirando o .htaccess os testes abaixo funcionam.
#### Primeiro, salvo o arquivo descomentando o FileService::save
#### Checo se o arquivo esta no local que eu mandei ele ir
#### Depois, rodo o script novamente, porem com as linhas
#### $comprovante->setArquivo(FileService::getPath() . "2/10/papel.png");
#### e tambem FileService::remove 
#### descomentadas. Funciona.
####
####


/*
$idprof = 2;
$idAtiv = 10;
$comprovante = new Comprovante();
$comprovante->setArquivo("/var/www/papel.png");

//FileService::save($idprof, $idAtiv, $comprovante);
//echo $comprovante->getArquivo();
$comprovante->setArquivo(FileService::getPath() . "2/10/papel.png");
FileService::remove($comprovante);
*/
?>