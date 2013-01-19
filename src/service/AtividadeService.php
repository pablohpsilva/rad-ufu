<?php

require_once(__DIR__.'/../DAO/postgres/AtividadeDAO.php');
require_once(__DIR__.'/TipoService.php');
require_once(__DIR__.'/ProfessorService.php');

atividade_id		SERIAL NOT NULL,
	atividade_tipo		INTEGER NOT NULL,
	atividade_descricao 	VARCHAR(255) NOT NULL,
	atividade_datainicio 	DATE,
	atividade_datafim 	DATE,
	atividade_professor	BIGINT NOT NULL,

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

	public function post($input){
		$this->dao->post(self::createObject($input));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input)->JsonSerialize();
	}

	public function searchAll(){
		$jsonArray = array();
		foreach ($this->dao->getAll() as $val) {
			$jsonArray[] = $val->JsonSerialize();
		}
		return $jsonArray;
	}

	public function update($id, $campo, $modificacao){
		$this->obj = self::get($id);
		switch (strtolower($campo)) {
			case '':
				$this->obj->set($modificacao);
				break;
			
			default:
				$this->obj->set($modificacao);
				break;
		}
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function getDependency($id){
		$idDep = self::get($id)->get();
		$dependency = new Service();
		return $dependency->get($idDep);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>