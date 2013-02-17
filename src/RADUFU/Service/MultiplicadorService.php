<?php
namespace RADUFU\Service;

use RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\MultiplicadorDAO,
    RADUFU\Model\Multiplicador;

class MultiplicadorService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = Factory::getFactory(Factory::PGSQL)->getMultiplicadorDAO();
	}

	public function createObject($nome, $valor, $limite, $tipo){
		$this->obj = new Multiplicador();
		$this->obj->setNome($nome);
		/*$this->obj->setValor($valor);*/
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
		//$this->dao->post(self::createObject($nome, $valor, $limite, $tipo));
		$this->dao->post(self::createObject($nome, $limite, $tipo));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll(){
		return $this->dao->getAll();
	}

	public function update($id, $nome, $limite, $tipo){
		self::createObject($nome, $limite, $tipo);
		$this->obj->setId($id);
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