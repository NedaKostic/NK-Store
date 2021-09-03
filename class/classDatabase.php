<?php
class Database {
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    protected $db;

    public function __construct(){
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "nkstore";
    }

    public function connect(){
        $this->db = @mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if(!$this->db) 
            return false;
        $this->query("SET NAMES utf8");
        return $this->db;
    }

    public function query($sql){
        return mysqli_query($this->db, $sql);
    }

    public function num_rows($result){
        return mysqli_num_rows($result);
    }

    public function fetch_assoc($result){
        return mysqli_fetch_assoc($result);
    }

    public function fetch_object($result){
        return mysqli_fetch_object($result);
    }

    public function fetch_all($result){
         return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function error(){
        return mysqli_error($this->db);
    }

    public function errno(){
        return mysqli_errno($this->db);
    }

    public function insert_id(){
        return mysqli_insert_id($this->db);
    }

}
