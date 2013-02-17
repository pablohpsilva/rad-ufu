<?php
namespace RADUFU\Service;

use RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\AtividadeDAO,
    RADUFU\Model\Atividade;

class AtividadeService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = Factory::getFactory(Factory::PGSQL)->getAtividadeDAO();
	}

	public function createObject($tipo, $descricao, $datainicio, $datafim, $valor, $professor){
		$this->obj = new Atividade();
		$this->obj->setTipo($tipo);
		$this->obj->setDescricao($descricao);
		$this->obj->setDataInicio($datainicio);
		$this->obj->setDataFim($datafim);
		$this->obj->setValor($valor);
		$this->obj->setProfessor($professor);
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
	
	public function post($tipo, $descricao, $datainicio, $datafim, $valor, $professor){
		$this->dao->post(self::createObject($tipo, $descricao, $datainicio, $datafim, $valor, $professor));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll($idProfessor = null){
		if(is_null($idProfessor))
			return $this->dao->getAll();
		else{
			$response = self::searchAll();
			$vector = array();
			foreach ($response as $val) {
				if($val->getProfessor() == $idProfessor)
					$vector[] = $val;
			}
			unset($val,$response);
			return $vector;
		}
	}

	public function update($id, $tipo, $descricao, $datainicio, $datafim, $valor, $professor){
		self::createObject($tipo, $descricao, $datainicio, $datafim, $valor, $professor);
		$this->obj->setId($id);
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function getDependency($id, $choose){
		$idDep = null;
		$dependency = null;
		switch (strtolower($choose)) {
			case 'tipo':
				$idDep = self::get($id)->getTipo();
				$dependency = new TipoService();
				break;
			default:
				$idDep = self::get($id)->getProfessor();
				$dependency = new ProfessorService();
				break;
		}
		return $dependency->get($idDep);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}
?>