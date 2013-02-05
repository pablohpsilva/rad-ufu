<?php

require_once(__DIR__.'/../DAO/postgres/AtividadeDAO.php');
#require_once(__DIR__.'/TipoService.php');
#require_once(__DIR__.'/ProfessorService.php');

class AtividadeService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = new AtividadeDAO();
	}

	public function createObject($tipo, $descricao, $datainicio, $datafim, $professor){
		$this->obj = new Atividade();
		$this->obj->setTipo($tipo);
		$this->obj->setDescricao($descricao);
		$this->obj->setDataInicio($datainicio);
		$this->obj->setDataFim($datafim);
		$this->obj->setProfessor($professor);
		return $this->obj;
	}

	public function get($input){
			return $this->dao->get($input);
	}

	public function read($input){
		return $this->dao->read($input);
	}
	
	public function post($tipo, $descricao, $datainicio, $datafim, $professor){
		$this->dao->post(self::createObject($tipo, $descricao, $datainicio, $datafim, $professor));
		unset($this->obj);
	}

	public function search($input,$choose=1){
		if($choose==1)
			return self::read($input);
		else
			return self::get($input);
	}
/*
	public function searchAll(){
		$jsonArray = array();
		foreach ($this->dao->getAll() as $val) {
			$jsonArray[] = $val->JsonSerialize();
		}
		return $jsonArray;
	}
*/
	public function update($id, $campo, $modificacao){
		$this->obj = self::get($id);
		switch (strtolower($campo)) {
			case 'tipo':
				$this->obj->setTipo($modificacao);
				break;
			case 'descricao':
				$this->obj->setDescricao($modificacao);
				break;
			case 'datainicio':
				$this->obj->setDataInicio($modificacao);
				break;
			case 'datafim':
				$this->obj->setDataFim($modificacao);
				break;
			
			default:
				$this->obj->setProfessor($modificacao);
				break;
		}
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