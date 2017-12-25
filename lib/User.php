<?php
/**
 * Created by PhpStorm.
 * User: Riad Mahmud
 * Date: 12/24/2017
 * Time: 8:14 PM
 */
include_once 'Session.php';
include 'Database.php';
class User{
    private $db;
    public function __construct(){
    $this->db = new Database();
    }
    public function userRegistration($data){
        $name =$data['name'];
        $username =$data['username'];
        $email =$data['email'];
        $password = $data['password'];
        $email_check=$this->emailCheck($email);

        if ($name=="" OR $username=="" OR $email=="" OR $password==""){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Field must not be Empty</div>";
            return $msg;

        }
        if($email_check ==true){
            $msg="<div class='alert alert-danger'><strong>Error !</strong>The email already Exist</div>";
            return $msg;

        }
        $password = md5($data['password']);
        $sql="INSERT INTO users (name,username,email,password) VALUES (:name,:username,:email,:password)";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':name',$name);
        $query->bindValue(':username',$username);
        $query->bindValue(':email',$email);
        $query->bindValue(':password',$password);
        $result= $query->execute();
        if($result){
            $msg="<div class='alert alert-success'><strong>success !</strong></div>";
            return $msg;
        }
    }
    public function emailCheck($email){
        $sql="SELECT email FROM users WHERE email = :email";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();
        if ($query->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }
    public function getLoginUser($email,$password){
        $sql="SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->bindValue(':password',$password);
        $query->execute();
        $result= $query->fetch(PDO::FETCH_OBJ);
        return $result;

    }
    public  function userLogin($data)
    {
        $email = $data['email'];
        $password = md5($data['password']);
        if ($email == "" OR $password == "") {
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Field must not be Empty</div>";
            return $msg;
        }
        $result = $this->getLoginUser($email, $password);
        if ($result) {
            Session::init();
            Session::set("login", true);
            Session::set("id", $result->id);
            Session::set("name", $result->name);
            Session::set("username", $result->username);
//            Session::set("loginsmg", "<div class='alert alert-success'><strong>Success </strong>You are Logged in</div>");
            header("Location: index.php");

        } else {
            $msg = "<div class='alert alert-danger'><strong>Error !</strong>Data not Found !</div>";
            return $msg;
        }
    }
    public function getUserdata(){
        $sql="SELECT * FROM users ORDER BY id DESC";
        $query=$this->db->pdo->prepare($sql);
        $query->execute();
        $result =$query->fetchAll();
        return $result;
    }
    public function getuserByID($id){
        $sql="SELECT * FROM users WHERE id = :id LIMIT 1";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':id',$id);
        $query->execute();
        $result= $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function userUpdate($id,$data){
        $name =$data['name'];
        $username =$data['username'];
        $email =$data['email'];

        if ($name=="" OR $username=="" OR $email==""){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Field must not be Empty</div>";
            return $msg;
        }
        $sql="UPDATE users set 
              name = :name, 
              username = :username,
               email = :email
                WHERE id = :id";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':name',$name);
        $query->bindValue(':username',$username);
        $query->bindValue(':email',$email);
        $query->bindValue(':id',$id);
        $result= $query->execute();
        header("Location: index.php");

        if($result){
            $msg="<div class='alert alert-success'><strong>success !</strong></div>";
            return $msg;
        }
    }
    public function Updatepassword($id,$data){
        $oldpss =$data['old_password'];
        $newpss =$data['password'];
        if ($oldpss == "" OR $newpss ==""){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Field must not be Empty</div>";
            return $msg;
        }
        $password=md5($newpss);
        $sql="UPDATE users set 
              password = :password
                WHERE id = :id";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':password',$password);
        $query->bindValue(':id',$id);
        $result= $query->execute();
        if($result){
            $msg="<div class='alert alert-success'><strong>success !</strong></div>";
            return $msg;
        }

    }
}
