<?php
/**
 * Created by PhpStorm.
 * User: Riad Mahmud
 * Date: 12/24/2017
 * Time: 8:10 PM
 */

class Database{
    private $host = "localhost";
    private $db_name = "db";
    private $username = "root";
    private $password = "";
    public $pdo;
    public function __construct(){
        if (!isset($this->pdo)) {
            try{
                $link = new PDO("mysql:host=".$this->host."; dbname=".$this->db_name,$this->username,$this->password);
                $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $link->exec("SET CHARACTER SET utf8");
                $this->pdo=$link;
            }catch(PDOException $e){
                die("Failed to connet with database".$e->getMessage());
            }
        }
    }

}