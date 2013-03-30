<?php
namespace RADUFU\Service;

use RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\AtividadeDAO,
    RADUFU\Model\Atividade,
    RADUFU\Service\TipoService;

class AtividadeService{
	private $dao;
	private $tipoService;
	private $obj;

	public function __construct(){
		$this->dao = Factory::getFactory(Factory::PGSQL)->getAtividadeDAO();
		$this->tipoService = new TipoService();
	}

	private function createObject($id = null, $tipo, $descricao, $datainicio, $datafim, $valorMult, $comprovante = null){
		$this->obj = new Atividade();
		$this->obj->setId($id);
		$this->obj->setTipo($tipo);
		$this->obj->setDescricao($descricao);
		$this->obj->setDataInicio($datainicio);
		$this->obj->setDataFim($datafim);
		$this->obj->setMultValor($valorMult);

		if(!is_null($comprovante))
			foreach ($comprovante as $val) {
				$this->obj->add($val);
			}

		return $this->obj;
	}

	public function deleteCollection($collection){
		foreach ($collection as $val) {
			self::delete($val->getId());
		}
	}

	public function addCollection($collection,$idProfessor){
		foreach ($collection as $val) {
			$this->dao->post($val,$idProfessor);
		}
	}

	public function getNextId(){
		return $this->dao->getNextId();
	}

	public function get($input){
		return $this->dao->get($input);
	}

	public function post($tipo, $descricao, $datainicio, $datafim, $valorMult, $comprovante, $professor, $id = null){
		$tipo = $this->tipoService->get($tipo);
		$this->dao->post(self::createObject($id, $tipo, $descricao, $datainicio, $datafim, $valorMult, $comprovante), $professor);
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll($idProfessor = null){
		if(!is_null($idProfessor))
			return $this->dao->read($idProfessor);
		else
			return $this->dao->getAll();
	}

	public function update($id, $tipo, $descricao, $datainicio, $datafim, $valorMult, /*$comprovantes,*/ $professor){
		//$comprovanteservice = new ComprovanteService();
		//LazyUpdater::lazyUpdaterJob(self::get($id)->getComprovantes(), $comprovantes, $comprovanteservice);
		$tipo = $this->tipoService->get($tipo);
		self::createObject($id, $tipo, $descricao, $datainicio, $datafim, $valorMult);
		$this->dao->update($this->obj,$professor);

		unset($this->obj,$comprovanteservice);
	}

	public function delete($input){
		//$comprovante = new ComprovanteService();
		//$array = $comprovante->searchAll($input);

		//$comprovante->deleteCollection($array);

		// Deleto a atividade
		$this->dao->delete($input);

		//unset($comprovante,$array);
	}

}
?>