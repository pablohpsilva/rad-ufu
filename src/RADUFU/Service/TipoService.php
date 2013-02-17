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

	public function createObject($categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite){
		$this->obj = new Tipo();
		$this->obj->setCategoria($categoria);
		$this->obj->setDescricao($descricao);
		$this->obj->setPontuacao($pontuacao);
		$this->obj->setPontuacaoReferencia($pontuacaoreferencia);
		$this->obj->setPontuacaoLimite($pontuacaolimite);
		return $this->obj;
	}

	public function getNextId(){ 
		return $this->dao->getNextId(); 
	}

	public function get($input){
		return $this->dao->get($input);
	}

	public function post($categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite){
		$this->dao->post(self::createObject($categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll($idCategoria = null){
		if(is_null($idCategoria))
			return $this->dao->getAll();
		else{
			$response = self::searchAll();
			$vector = array();
			foreach ($response as $val) {
				if($val->getProfessor() == $idCategoria)
					$vector[] = $val;
			}
			unset($val,$response);
			return $vector;
		}
	}

	public function update($id, $categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite){
		self::createObject($categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite);
		$this->obj->getId($id);
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function getDependency($id){
		$idDep = self::get($id)->getCategoria();
		$dependency = new CategoriaService();
		return $dependency->get($idDep);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>