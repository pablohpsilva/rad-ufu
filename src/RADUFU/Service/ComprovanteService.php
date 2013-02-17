<?php
namespace RADUFU\Service;

use RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\ComprovanteDAO,
    RADUFU\Model\Comprovante,
    RADUFU\Service\FileService;

class ComprovanteService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = Factory::getFactory(Factory::PGSQL)->getComprovanteDAO();
	}

	public function createObject($arquivo, $atividade){
		$this->obj = new Comprovante();
		$this->obj->setArquivo($arquivo);
		$this->obj->setAtividade($atividade);
		return $this->obj;
	}

	public function getNextId(){ 
		return $this->dao->getNextId(); 
	}

	public function get($input){
		if(is_numeric($input))
			return $this->dao->get($input);
		else
			return $this->dao->read($input);
	}

	public function post($professor,$atividade,$arquivo){
		$file = FileService::createFile($professor,$atividade,$arquivo);
		if($file != -1){
			$this->dao->post(self::createObject($file, $atividade));
			unset($this->obj,$file);
		}
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll($idAtividade = null){
		if(is_null($idAtividade))
			return $this->dao->getAll();
		else{
			$response = self::searchAll();
			$vector = array();
			foreach ($response as $val) {
				if($val->getAtividade() == $idAtividade)
					$vector[] = $val;
			}
			unset($val,$response);
			return $vector;
		}
	}

	public function update($id, $arquivo, $atividade){
		$this->obj = self::get($id);
		
		$move = FileService::moveFile($this->obj->getArquivo(),$arquivo);
		if($move!=FALSE)
			$this->obj->setArquivo($move);

		$this->obj->setAtividade($atividade);

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