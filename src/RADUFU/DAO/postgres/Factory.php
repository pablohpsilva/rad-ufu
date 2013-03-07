<?php

namespace RADUFU\DAO\postgres;

class Factory extends \RADUFU\DAO\Factory {

    public function getAtividadeDAO() {
        return new AtividadeDAO();
    }

    public function getCategoriaDAO() {
        return new CategoriaDAO();
    }

    public function getComprovanteDAO() {
        return new ComprovanteDAO();
    }

    public function getMultiplicadorDAO() {
        return new MultiplicadorDAO();
    }

    public function getProfessorDAO() {
        return new ProfessorDAO();
    }

    public function getTipoDAO() {
        return new TipoDAO();
    }

}

?>