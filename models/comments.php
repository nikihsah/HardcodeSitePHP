<?php


class comments
{

private $idbook;

    function __construct($id){
        $this -> idbook = $id;
    }

    public static function getall(){
        $connect = connect();
        $result = mysqli_query($connect, 'SELECT * FROM `comments`');
        while ($row = mysqli_fetch_assoc($result)) {
            $tablesRows[] = $row;
        }
        return $tablesRows;
    }

    public function getcomments(){
        $tablesRows = [];
        $connect = connect();
        $query = sprintf("SELECT idBook, users.username, text
            FROM `comments` 
                inner join users on users.id = comments.idUser
            WHERE idBook = %s",
            $this->idbook);
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $tablesRows[] = $row;
        }
        return $tablesRows;
    }

    public function addcomment($idUser, $text){
        $connect = connect();
        $query = sprintf("INSERT INTO `comments`(`idUser`, `idBook`, `text`) 
            VALUES (%s, %s, '%s')",
            $idUser, $this->idbook, $text);
        $result = mysqli_query($connect, $query);
    }
}