<?php
require_once (ROOT . '/rb.php');


class authors
{

    public static function getall()
    {
        $connect = connect();
        $result = mysqli_query($connect, 'SELECT authors.id, authors.FIO, authors.birthday, authors.city, authors.death From authors');
        while ($row = mysqli_fetch_assoc($result)) {
            $tablesRows[] = $row;
        }

//        $book = R::dispense('author');
//        $tablesRows = R::loadAll('authors', 1);

        return $tablesRows;
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