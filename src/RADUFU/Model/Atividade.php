<?php

namespace RADUFU\Model;

use \JsonSerializable;

class Atividade implements JsonSerializable{
	private $id;
    private $tipo;
    private $descricao;
    private $datainicio;
    private $datafim;
    private $valorMult;
    private $comprovante = array();
    //private $professor;

    /*GETTERS*/
    public function getId(){return $this->id;}
    public function getTipo(){return $this->tipo;}
    public function getDescricao(){return $this->descricao;}
    public function getDataInicio(){return $this->datainicio;}
    public function getDataFim(){return $this->datafim;}
    public function getValorMult(){ return $this->valorMult;}
    //public function getProfessor(){return $this->professor;}
    public function getComprovante(){ return $this->comprovante }

    /*SETTERS*/
    public function setId($input){$this->id = $input;}
    public function setTipo($input){$this->tipo = $input;}
    public function setDescricao($input){$this->descricao = $input;}
    public function setDataInicio($input){$this->datainicio = $input;}
    public function setDataFim($input){$this->datafim = $input;}
    public function setValorMult($input){$this->valorMult = $input;}
    //public function setProfessor($input){$this->professor = $input;}
    public function setComprovante(Comprovante $comprovante){ self::add($comprovante); }

    public function add(Comprovante $comprovante){
        if(!in_array($comprovante, $this->comprovante))
            self::getComprovante()[] = $this->comprovante;
    }

    public function remove(Comprovante $comprovante){
        $key = array_search($comprovante, $this->comprovante);
        if($key != FALSE)
            unset($this->comprovante[$key]);
    }

    public function JsonSerialize() {
        return [
            'uri' => 'atividade/' . $this->getId(),
            'tipo' => $this->getTipo(),
            'descricao' => $this->getDescricao(),
            'datainicio' => $this->getDataInicio(),
            'datafim' => $this->getDataFim(),
            'valorMult' => $this->getValorMult(),
            /*'professor' => $this->getProfessor(),*/
            'comprovante' => $this->getComprovante()
        ];
    }
  }
?>