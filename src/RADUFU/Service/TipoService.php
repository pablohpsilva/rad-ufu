<?php
namespace RADUFU\Service;

use RADUFU\DAO\postgres\TipoDAO,
    RADUFU\Model\Tipo;

/*
require_once(__DIR__.'/../DAO/postgres/TipoDAO.php');
#require_once(__DIR__.'/CategoriaService.php');
*/
class TipoService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = new TipoDAO();
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
			case 'descricao':
				$this->obj->setDescricao($modificacao);
				break;
			case 'pontuacao':
				$this->obj->setPontuacao($modificacao);
				break;
			case 'pontuacaoreferencia':
				$this->obj->setPontuacaoReferencia($modificacao);
				break;
			case 'pontuacaolimite':
				$this->obj->setPontuacaoLimite($modificacao);
				break;
			
			default:
				$this->obj->setCategoria($modificacao);
				break;
		}
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