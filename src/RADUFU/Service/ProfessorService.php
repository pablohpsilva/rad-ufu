<?php
namespace RADUFU\Service;

use RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\ProfessorDAO,
    RADUFU\Model\Professor;

class ProfessorService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = Factory::getFactory(Factory::PGSQL)->getProfessorDAO();
	}

	public function createObject($id = null, $siape = null, $nome, $senha, $atividades = null){
		$this->obj = new Professor();
		$this->obj->setId($id);
		$this->obj->setNome($nome);
		$this->obj->setSenha($senha);
		
		if(!is_null($siape))
			$this->obj->setSiape($siape);

		if(!is_null($atividades))
			foreach ($atividades as $val) {
				$this->obj->addAtividade($val);
			}
		
		return $this->obj;
	}

	public function get($input){
		return $this->dao->get($input);
	}

	public function post($siape, $nome, $senha, $id = null){
		$this->dao->post(self::createObject($id, $siape, $nome, $senha, null));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}
	
	// Unica excessao. Aqui pode-se usar a pesquisa por SIAPE. O retorno sera um unico objeto...
	// Contrariando o restante das funcoes searchAll() dos outros Services.
	public function searchAll($siape = null){
		if(!is_null($siape))
			return $this->dao->read($siape);
		else
			return $this->dao->getAll();
	}

	public function update($id, $nome, $senha, $atividades = null){
		if(!is_null($atividades)){
			$atividadeservice = new AtividadeService();
			LazyUpdater::lazyUpdaterJob(self::get($id)->getAtividades(), $atividades, $atividadeservice);
		}

		self::createObject($id, null, $nome, $senha, $atividades);
		$this->dao->update($this->obj);

		unset($this->obj,$atividadeservice);
	}

	public function delete($input){
		//$atividade = new AtividadeService();
		//$array = $atividade->searchAll($input);

		//$atividade->deleteCollection($array);

		$this->dao->delete($input);

		unset($atividade,$array);
	}

}

?>
