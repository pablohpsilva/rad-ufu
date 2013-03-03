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

	private function createObject($id = null, $arquivo){
		$this->obj = new Comprovante();
		$this->obj->setId($id);
		$this->obj->setArquivo($arquivo);
		return $this->obj;
	}

	public function deleteCollection($collection){
		foreach ($collection as $val) {
			self::delete($val->getId());
		}
	}

	public function addCollection($collection,$idAtividade){
		foreach ($collection as $val) {
			$this->dao->post($val,$idAtividade);
		}
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

	public function post($arquivo,$atividade,$id = null){
		$this->dao->post(self::createObject($id,$file),$atividade);
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll($idAtividade = null){
		if(!is_null($idAtividade))
			return $this->dao->read($idAtividade);
		else
			return $this->dao->getAll();
	}

	/*
	 * Conferir como esse metodo funcionara com o front-end.
	*/
	public function update($id, $arquivo, $atividade){
		$this->obj = self::get($id);
		
		$move = FileService::moveFile($this->obj->getArquivo(),$arquivo);
		if($move!=FALSE)
			$this->obj->setArquivo($move);

		$this->obj->setAtividade($atividade);

		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function delete($input){
		$this->obj = self::get($input);
		FileService::removeFile($this->obj->getArquivo());
		unset($this->obj);
		$this->dao->delete($input);
	}

}

?>