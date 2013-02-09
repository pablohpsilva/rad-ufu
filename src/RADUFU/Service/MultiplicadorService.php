<?php

require_once(__DIR__.'/../DAO/postgres/MultiplicadorDAO.php');
#require_once(__DIR__.'/TipoService.php');

class MultiplicadorService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = new MultiplicadorDAO();
	}

	public function createObject($nome, $valor, $limite, $tipo){
		$this->obj = new Multiplicador();
		$this->obj->setNome($nome);
		$this->obj->setValor($valor);
		$this->obj->setLimite($limite);
		$this->obj->setTipoAtividade($tipo);
		return $this->obj;
	}

	public function get($input){
		if(is_numeric($input))
			return $this->dao->get($input);
		else
			return $this->dao->read($input);
	}
	
	public function post($nome, $valor, $limite, $tipo){
		$this->dao->post(self::createObject($nome, $valor, $limite, $tipo));
		unset($this->obj);
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
			case 'nome':
				$this->obj->setNome($modificacao);
				break;
			case 'valor':
				$this->obj->setValor($modificacao);
				break;
			case 'limite':
				$this->obj->setLimite($modificacao);
				break;
			
			default:
				$this->obj->setTipoAtividade($modificacao);
				break;
		}
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function getDependency($id){
		$idDep = self::get($id)->getTipoAtividade();
		$dependency = new TipoService();
		return $dependency->get($idDep);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>