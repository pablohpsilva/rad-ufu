<?php

namespace RADUFU\Model;

use \JsonSerializable,
    RADUFU\util\LazyDelCollection;

class Atividade implements JsonSerializable{
	private $id;
    private $tipo;
    private $descricao;
    private $datainicio;
    private $datafim;
    private $valorMult;
    private $comprovante;

    public function __construct(){
        $this->comprovante = new LazyDelCollection();
    }

    /*GETTERS*/
    public function getId(){return $this->id;}
    public function getTipo(){return $this->tipo;}
    public function getDescricao(){return $this->descricao;}
    public function getDataInicio(){return $this->datainicio;}
    public function getDataFim(){return $this->datafim;}
    public function getMultValor(){ return $this->valorMult;}
    public function getComprovantes(){ return $this->comprovante; }

    /*SETTERS*/
    public function setId($input){$this->id = $input;}
    public function setTipo(Tipo $input){$this->tipo = $input;}
    public function setDescricao($input){$this->descricao = $input;}
    public function setDataInicio($input){$this->datainicio = $input;}
    public function setDataFim($input){$this->datafim = $input;}
    public function setMultValor($input){$this->valorMult = $input;}
    public function addComprovante(Comprovante $comprovante){ $this->comprovante->add($comprovante); }
    public function removeComprovante($id){ $this->comprovante->remove($id); }

    public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'descricao' => $this->getDescricao(),
            'datainicio' => $this->getDataInicio(),
            'datafim' => $this->getDataFim(),
            'comprovantes' => $this->getComprovantes(),
            'tipo' => $this->getTipo()->getId(),
            'valorMult' => $this->getMultValor()
        ];
    }
  }
?>