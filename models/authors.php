<?php

class authors
{

    public static function getall()
    {
        $connect = connect();
        return mysqli_query($connect, 'SELECT authors.id, authors.FIO, authors.birthday, authors.city, authors.death From authors');
    }

    public static function delete($id)
    {
        $connect = connect();
        return mysqli_query($connect, "DELETE FROM authors WHERE id = '$id'");
    }

    public static function upp($id, $FIO, $birthday, $death, $city)
    {
        $connect = connect();
        return mysqli_query($connect, "UPDATE authors
        SET FIO = '$FIO', birthday = '$birthday', death = '$death', city = '$city'
        WHERE id = $id");
    }
}