<?php

namespace RADUFU\DAO;

class NotFoundException extends Exception {

    function __construct() {
        parent::__construct('A entidade não foi encontrada');
    }
}

?>