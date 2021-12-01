<?php

class books
{
    public static function getall()
    {
        $table = R::findAll('books');
        foreach($table as $key => $value){
            $tablesRows[$key-1]['id'] = $value['id'];
            $tablesRows[$key-1]['name'] = $value['name'];
            $tablesRows[$key-1]['years'] = $value['years'];
            $tablesRows[$key-1]['description'] = $value['description'];
            $tablesRows[$key-1]['city'] = $value['city'];

            $tablesRows[$key-1]['authorid'] = $value['idauthor'];
            $autho = R::load('authors', $value['idauthor']);
            $tablesRows[$key-1]['FIO'] = $autho['fio'];

            $tablesRows[$key-1]['genreid'] = $value['idgenre'];
            $autho = R::load('genres', $value['idgenre']);
            $tablesRows[$key-1]['genre'] = $autho['genre'];
        }

        return $tablesRows;

    }

    public static function get(int $id){
        $connect = connect();
        $result = mysqli_query($connect, "SELECT books.id, books.name, books.years, books.description, 
        books.city, books.idAuthor as authorsid, authors.FIO, books.idGenre as genreid, genres.genre 
        FROM books inner join genres ON books.idGenre = genres.id 
        inner join authors ON books.idAuthor = authors.id WHERE books.id = $id");
        while ($row = mysqli_fetch_assoc($result)) {
            $tablesRows[] = $row;
        }
        return $tablesRows;
    }

    public static function delete($id)
    {

        $table = R::load('books', $id);
        R::trash($table);
    }

    public static function upp($id, $fio, $genre, $name, $city, $years, $description)
    {
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        $book = R::load('books', $id);

        $book->name = $name;
        $book->years = $years;
        $book->description = $description;
        $book->city = $city;
        $book->idauthor = $fio;
        $book->idfenre = $genre;

        $book = R::store($book);
    }

    public static function getGenre($id)
    {
        $connect = connect();
        return mysqli_query($connect, "SELECT genres.id, genre 
                                             FROM genres inner join books ON books.idGenre = genres.id 
                                             WHERE books.id = $id");
    }

    public static function getAuthor($id)
    {
        $connect = connect();
        return mysqli_query($connect, "SELECT authors.id, FIO 
                                             FROM authors inner join books ON books.idAuthor = authors.id 
                                             WHERE books.id = $id");
    }

    public static function add($name, $years, $description, $city, $idAuthor, $idGenre)
    {

        $book = R::dispense('books');

        $book->name = $name;
        $book->years = $years;
        $book->description = $description;
        $book->city = $city;
        $book->idauthor = $idAuthor;
        $book->idgenre = $idGenre;

        $book = R::store($book);

        return true;
    }
}