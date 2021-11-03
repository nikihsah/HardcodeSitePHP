<?php


class books
{
    public static function getall()
    {
        $connect = connect();
        $result = mysqli_query($connect, 'SELECT books.id, books.name, books.years, books.description, 
       books.city, authors.id as authorsid, authors.FIO, authors.birthday, authors.city, 
       authors.death, genres.id as genreid, genres.genre 
        FROM books inner join genres ON books.idGenre = genres.id 
        inner join authors ON books.idAuthor = authors.id');
        while ($row = mysqli_fetch_assoc($result)) {
            $tablesRows[] = $row;
        }
        return $tablesRows;
    }

    public static function delete($id)
    {
        $connect = connect();
        return mysqli_query($connect, "DELETE FROM books WHERE id = '$id'");
    }

    public static function upp($id, $FIO, $genre, $name, $city, $years, $description)
    {
        $connect = connect();
        return mysqli_query($connect,"UPDATE books
        SET name = '$name', years = '$years', description = '$description', city = '$city',
            idAuthor = '$FIO', idGenre = '$genre'
        WHERE id = $id
        ");
    }
}