<?php

namespace RADUFU\DAO\postgres;

/**
 * DAO factory para o postgres
 */
class Factory extends \DAO\factorydao {

    public abstract function getProfessorDAO(){return new ProfessorDAO();}

    public abstract function getCategoriaDAO(){return new CategoriaDAO();}

    public abstract function getMultiplicadorDAO(){return new MultiplicadorDAO();}

    public abstract function getAtividadeDAO(){return new ComprovanteDAO();}

    public abstract function getComprovanteDAO(){return new ComprovanteDAO();}

    public abstract function getAtividadeDAO(){return new AtividadeDAO();}

}

?>
