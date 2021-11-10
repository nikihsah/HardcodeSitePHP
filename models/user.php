<?php
include('Auser.php');
include('interfUser.php');

class user extends Auser implements interfUser
{
    private $password;
    private $email;
    private $rank;
    private $username;
    private $id;

    public static function getall()
    {
        $connect = connect();
        $result = mysqli_query($connect, 'SELECT * FROM `users`');
        while ($row = mysqli_fetch_assoc($result)) {
            $tablesRows[] = $row;
        }
        return $tablesRows;
    }

    public function showInfo(){
        return ['username' => $this -> username,
            'password' => $this -> password,
            'email' => $this -> email,
            'rank' => $this -> rank,
            'id' => $this -> id];
    }

    function __construct(string $password,string $email,int $rank,string $username,int $id){
        $this -> email = $email;
        $this -> password = $password;
        $this -> rank = $rank;
        $this -> id = $id;
        $this -> username = $username;
    }

    public function adduser(){
        $connect = connect();
        return mysqli_query($connect, "INSERT INTO `users`(`username`, `password`, `email`, `rank`) 
                                        VALUES ('$this->username',
                                                '$this->password',
                                                '$this->email',
                                                '$this->rank')");
    }

//    __________________GET________________
    public  function getusername()
    {
        return $this -> username;
    }

    public  function getemail()
    {
        return $this -> email;
    }

    public  function getpassword()
    {
        return $this -> password;
    }

    public  function getrank()
    {
        return $this -> rank;
    }

    public  function getid()
    {
        return $this -> id;
    }

//    __________________SET________________
    public  function setusername($username)
    {
        $this -> username = $username;
    }

    public  function setemail($email)
    {
        $this -> username = $email;
    }

    public  function setpassword($password)
    {
        $this -> username = $password;
    }

    public  function setrank($rank)
    {
        $this -> username = $rank;
    }
}