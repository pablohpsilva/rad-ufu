<?php
namespace RADUFU\Service;

use RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\TipoDAO,
    RADUFU\Model\Tipo;

class TipoService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = Factory::getFactory(Factory::PGSQL)->getTipoDAO();
	}

	public function createObject($categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite, $multiplicador, $id = null){
		$this->obj = new Tipo();
		$this->obj->setId($id);
		$this->obj->setCategoria($categoria);
		$this->obj->setDescricao($descricao);
		$this->obj->setPontuacao($pontuacao);
		$this->obj->setPontuacaoReferencia($pontuacaoreferencia);
		$this->obj->setPontuacaoLimite($pontuacaolimite);
		$this->obj->setMultiplicador($multiplicador);
		return $this->obj;
	}

	public function getNextId(){ 
		return $this->dao->getNextId(); 
	}

	public function get($input){
		return $this->dao->get($input);
	}

	public function post($categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite, $multiplicador, $id = null){
		$this->dao->post(self::createObject($categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite, $multiplicador,$id));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll($idCategoria = null){
		if(!is_null($idCategoria))
			return $this->read($idCategoria);
		else
			return $this->dao->getAll();
	}

	public function update($id, $categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite, $multiplicador){
		self::createObject($categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite, $multiplicador, $id);
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>