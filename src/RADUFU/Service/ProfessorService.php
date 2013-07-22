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
		$this->obj->setNome(Security::filterLetters($nome));
		$this->obj->setSenha(Security::encrypt($senha,$siape));
		
		if(!is_null($siape))
			$this->obj->setSiape(Security::encrypt($siape,$senha));

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
		$this->dao->post(self::createObject($id, Security::filterNumbers($siape), $nome, $senha, null));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll($siape = null){
		if(!is_null($siape))
			return $this->dao->read($siape);
		else
			return $this->dao->getAll();
	}

	public function update($id, $siape, $nome, $senha, $atividades = null){
		if(!is_null($atividades)){
			$atividadeservice = new AtividadeService();
			LazyUpdater::lazyUpdaterJob(self::get($id)->getAtividades(), $atividades, $atividadeservice);
		}

		self::createObject($id, Security::filterNumbers($siape), $nome, $senha, $atividades);
		$this->dao->update($this->obj);

		unset($this->obj,$atividadeservice);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

	public function login($siape,$senha){
		return $this->dao->login(Security::encrypt($siape,$senha),Security::encrypt($senha,$siape));
	}

}

?>
