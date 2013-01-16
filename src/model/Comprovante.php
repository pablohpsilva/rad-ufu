<?php

//namespace model;

class Comprovante implements JsonSerializable{
	private $id;
	private $arquivo;
	private $atividade;

	/* GETTERS */
	public function getId(){ return $this->id;}
	public function getArquivo(){ return $this->arquivo;}
	public function getAtividade(){ return $this->atividade;}

	/* SETTERS */
	public function setId($input){$this->id = $input;}
	public function setArquivo($input){$this->arquivo = $input;}
	public function setAtividade($input){$this->atividade = $input;}

	public function JsonSerialize() {
        return [
            'uri' => 'comprovante/' . $this->getId(),
            'arquivo' => $this->getArquivo(),
            'atividade' => $this->getAtividade(),
        ];
    }
}

?>