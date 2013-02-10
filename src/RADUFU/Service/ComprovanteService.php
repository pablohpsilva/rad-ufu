<?php
namespace RADUFU\Service;

use RADUFU\DAO\postgres\ComprovanteDAO,
    RADUFU\Model\Comprovante,
    RADUFU\Service\FileService;

/*
require_once(__DIR__.'/../DAO/postgres/ComprovanteDAO.php');
#require_once(__DIR__.'/AtividadeService.php');
*/
class ComprovanteService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = new ComprovanteDAO();
	}

	public function createObject($arquivo, $atividade){
		$this->obj = new Comprovante();
		$this->obj->setArquivo($arquivo);
		$this->obj->setAtividade($atividade);
		return $this->obj;
	}

	public function get($input){
		if(is_numeric($input))
			return $this->dao->get($input);
		else
			return $this->dao->read($input);
	}

	public function post($professor,$arquivo, $atividade){
		$file = FileService::createFile($professor,$atividade,$arquivo);
		if($file != -1){
			$this->dao->post(self::createObject($file, $atividade));
			unset($this->obj);
			return $file;
		}
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll(){
		$jsonArray = array();
		foreach ($this->dao->getAll() as $val) {
			$jsonArray[] = $val;
		}
		return $jsonArray;
	}

	public function update($id, $campo, $modificacao){
		$this->obj = self::get($id);
		switch (strtolower($campo)) {
			case 'arquivo':
				$mod = FileService::moveFile($this->obj->getArquivo(),$modificacao);
				if($mod!=FALSE)
					$this->obj->setArquivo($mod);
				break;
			
			default:
				$this->obj->setAtividade($modificacao);
				break;
		}
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function getDependency($id){
		$idDep = self::get($id)->getAtividade();
		$dependency = new AtividadeService();
		return $dependency->get($idDep);
	}

	public function delete($input){
		$this->obj = self::get($input);
		FileService::removeFile($this->obj->getArquivo());
		unset($this->obj);
		$this->dao->delete($input);
	}

}

?>