<?php

namespace RADUFU\DAO;

abstract class factorydao {

	/*
		Crie consts para variar o BD que sera usado.
		Lista:
			1 = Postegres
			...
	*/
    const PGSQL = 1;


    public abstract function getProfessorDAO();

    public abstract function getCategoriaDAO();

    public abstract function getMultiplicadorDAO();

    public abstract function getAtividadeDAO();

    public abstract function getComprovanteDAO();

    public abstract function getAtividadeDAO();

    public static function getFactory($factory) {
        switch ($factory)
        {
            case (self::PGSQL):
                return new Postgresql\Factory();

            default: return null;
        }
    }

}

?>
