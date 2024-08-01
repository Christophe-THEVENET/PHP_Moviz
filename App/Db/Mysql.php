<?php

namespace App\Db;

class Mysql 
{
    private $db_name;
    private $db_user;
    private $db_password;
    private $db_port;
    private $db_host;
    private $pdo = null;
    private static $_instance = null;

    private function __construct()
    {
        require_once _ROOTPATH_.'/config.php';

        if (_DB_NAME_ !== null) {
            $this->db_name = _DB_NAME_;
        }
        if (_DB_USER_ !== null) {
            $this->db_user = _DB_USER_;
        }
        if (_DB_PASSWORD_ !== null) {
            $this->db_password = _DB_PASSWORD_;
        }
        if (_DB_PORT_ !== null) {
            $this->db_port = _DB_PORT_;
        }
        if  (_DB_HOST_ !== null) {
            $this->db_host = _DB_HOST_;
        }

    }

    public static function getInstance():self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Mysql();
        }
        return self::$_instance;
    }

    public function getPDO():\PDO
    {
        if (is_null($this->pdo)) {
            $this->pdo = new \PDO('mysql:dbname=' . $this->db_name . ';charset=utf8;host=' . $this->db_host.':'.$this->db_port, $this->db_user, $this->db_password);
        }
        return $this->pdo;
    }


}