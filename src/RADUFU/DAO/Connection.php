<?php

namespace RADUFU\DAO;

use \PDO;

class Connection {

    private static $DSN = 'pgsql:dbname=radufu;host=localhost';
    private static $USERNAME = 'radufu';
    private static $PASSWORD = 'radufu';
    private static $instance = null;
    private $con = null;

    private function __construct() {
        $this->con = new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD);
    }

    public static function Instance() {
        if (self::$instance == null)
            self::$instance = new Connection();
        return self::$instance;
    }

    public function get() {
        return $this->con;
    }

}

?>
