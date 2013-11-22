<?php

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pwd = 'BCdDwsd1db6';
    private $db = 'activtest';

    private $mysql;
    private static $instance;

    private function __construct() {
        $this->mysql = mysqli_connect($this->host, $this->user, $this->pwd, $this->db) or die ("No database connection :(");

    }
    private function __clone() {}

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function addToDb($name, $email, $text) {
        $query = "INSERT INTO comment (name, email, text, update_time) VALUES ('$name', '$email',
            '$text', NOW())";
        $res = mysqli_query($this->mysql, $query);
        var_dump($res);
        if(!$res === false) {
            return true;
        }
        else {
            return false;
        }
    }
} 