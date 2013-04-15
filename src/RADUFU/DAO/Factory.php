<?php

namespace RADUFU\DAO;

abstract class Factory {

    const PGSQL = 1;

    public abstract function getAtividadeDAO();

    public abstract function getCategoriaDAO();

    public abstract function getComprovanteDAO();

    public abstract function getMultiplicadorDAO();

    public abstract function getProfessorDAO();

    public abstract function getTipoDAO();

    public static function getFactory($factory) {
        switch ($factory)
        {
            case (self::PGSQL):
                return new postgres\Factory();

            default: return null;
        }
    }

}

?>