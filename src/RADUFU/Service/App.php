<?php
require_once(__DIR__.'/Includes.php');
require_once(__DIR__.'/../DAO/LimparBanco.php');
class App{
	private $atividade;
	private $professor;
	private $tipo;
	private $categoria;
	private $comprovante;
	#private $multiplicador;

	public function __construct(){
		$this->atividade = new AtividadeService();
		$this->professor = new ProfessorService();
		$this->tipo = new TipoService();
		$this->categoria = new CategoriaService();
		$this->comprovante = new ComprovanteService();
		#$this->multiplicador = new MultiplicadorService();		
	}

	public function generateJSON($input){
		if(is_array($input)){
			$json = array();
			foreach ($input as $val)
				$json[] = $val->JsonSerialize();
			return $json;
		}
		else
			return $input->JsonSerialize();
	}
	
	public function getAtividadePorId($id){	return self::generateJSON($this->atividade->search($id,0)); }
	public function getAtividadePorProfessor($idProfessor){	return self::generateJSON($this->atividade->search($idProfessor)); }
	public function getAtividadePorTipo($idProfessor,$tipo){
		$aux = $this->atividade->search($idProfessor);
		$return = array();
		foreach ($aux as $val) {
			if($val->getTipo() == $tipo)
				$return[] = $val;
		}
		unset($val,$aux);
		return $return;
	}
	public function getAtividadePorCategoria($idProfessor, $idCategoria){
		$ap = self::getAtividadePorProfessor($idProfessor);
		$return = array();
		foreach ($ap as $val) {
			$aux = $this->atividade->getDependency($val->getId(),"tipo");
			if($aux->getCategoria() == $idCategoria)
				$return[] = $val;
		}
		unset($ap,$aux,$val);
		return $return;
	}
	
	public function getCategoriaPorId($id){ return $this->categoria->search($id); }
	public function getCategoriaTudo(){ return $this->categoria->searchAll(); }

	public function getTipoPorId($id){ return $this->tipo->search($id); }
	public function getTipoTudo(){return $this->tipo->searchAll(); }
	public function getTipoPorCategoria($idCategoria){
		$t = self::getTipoTupo();
		$return = array();
		foreach ($t as $val)
			if($val->getCategoria() == $idCategoria)
				$return[] = $val;
		unset($t,$val);
		return $return;
	}
	
	public function getComprovantePorId($id){ return $this->comprovante->search($id); }
	public function getComprovanteTudo(){ return $this->comprovante->searchAll(); }
	public function getComprovantePorAtividade($idAtividade){
		$c = self::getComprovanteTudo();
		$return = array();
		foreach ($c as $val) {
			if($val->getAtividade() == $idAtividade)
				$return[] = $val;
		}
		unset($c,$val);
		return $return;
	}

	#####################################################################################
	#####################################################################################
	#####################################################################################

	public function deleteAtividade($id){
		$c = getComprovantePorAtividade($id);
		foreach ($c as $val) {
			$this->comprovante->delete($val->getId());
		}
		$this->atividade->delete($id);
		unset($c,$val);
	}

	public function postAtividade($tipo, $descricao, $datainicio, $datafim, $professor, $arquivo){
		$this->atividade->post($tipo, $descricao, $datainicio, $datafim, $professor);
		$id;
		foreach ($this->atividade->search($professor) as $val)
			if($val->getDescricao() == $descricao && $val->getTipo() == $tipo && $val->getProfessor() == $professor){
				$id = $val->getId();
				break;
			}
		$this->comprovante->post($arquivo,$id);
		unset($id,$val);
	}


	#####################################################################################
	#####################################################################################
	#####################################################################################

	public function listarCategorias(){ return self::generateJSON(self::getCategoriaTudo()); }
	public function listarTipos(){ return self::generateJSON(self::getTipoTudo()); }
	public function listarAtividades($modo, $idA, $idB = NULL){
		$obj;
		switch ($modo) {
			case 'professor':
				$obj = self::getAtividadePorProfessor($idA);
				break;
			case 'categoria':
				$obj = self::getAtividadePorCategoria($idA,$idB);
				break;
			case 'tipo':
				$obj = self::getAtividadePorTipo($idA,$idB);
				break;
			default:
				$obj = self::getAtividadePorId($idA);
				break;
		}
		return self::generateJSON($obj);
	}
	public function listarComprovantes($modo = NULL,$idA = NULL){
		$obj;
		switch ($modo) {
			case 'id':
				$obj = self::getComprovantePorId($idA);
				break;
			case 'atividade':
				$obj = self::getComprovantePorAtividade($idA);
				break;
			default:
				$obj = self::getComprovanteTudo();
				break;
		}
		return self::generateJSON($obj);
	}

}

?>