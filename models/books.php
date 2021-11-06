<?php


class books
{
    public static function getall()
    {
        $connect = connect();
        $result = mysqli_query($connect, 'SELECT books.id, books.name, books.years, books.description, 
       books.city, books.idAuthor as authorsid, authors.FIO, books.idGenre as genreid, genres.genre 
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

    public static function getGenre($id){
        $connect = connect();
        return mysqli_query($connect, "SELECT genres.id, genre 
                                             FROM genres inner join books ON books.idGenre = genres.id 
                                             WHERE books.id = $id");
    }

    public static function getAuthor($id){
        $connect = connect();
        return mysqli_query($connect, "SELECT authors.id, FIO 
                                             FROM authors inner join books ON books.idAuthor = authors.id 
                                             WHERE books.id = $id");
    }
}