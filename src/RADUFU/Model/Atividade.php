<?php

namespace RADUFU\Model;

use \JsonSerializable;

class Atividade implements JsonSerializable{
	private $id;
    private $tipo;
    private $descricao;
    private $datainicio;
    private $datafim;
    private $valor;
    private $professor;

    /*GETTERS*/
    public function getId(){return $this->id;}
    public function getTipo(){return $this->tipo;}
    public function getDescricao(){return $this->descricao;}
    public function getDataInicio(){return $this->datainicio;}
    public function getDataFim(){return $this->datafim;}
    /*modificado o campo abaixo*/
    public function getValor(){ return $this->valor;}
    public function getProfessor(){return $this->professor;}

    /*SETTERS*/
    public function setId($input){$this->id = $input;}
    public function setTipo($input){$this->tipo = $input;}
    public function setDescricao($input){$this->descricao = $input;}
    public function setDataInicio($input){$this->datainicio = $input;}
    public function setDataFim($input){$this->datafim = $input;}
    /*modificado o campo abaixo*/
    public function setValor($input){$this->valor = $input;}
    public function setProfessor($input){$this->professor = $input;}

    public function JsonSerialize() {
        return [
            'uri' => 'atividade/' . $this->getId(),
            'tipo' => $this->getTipo(),
            'descricao' => $this->getDescricao(),
            'datainicio' => $this->getDataInicio(),
            'datafim' => $this->getDataFim(),
            'professor' => $this->getProfessor()
        ];
    }
  }
?>