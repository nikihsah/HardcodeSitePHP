<?php
require_once (ROOT . '/rb.php');


class authors
{

    public static function getall()
    {
        $table = R::findAll('authors');

        foreach($table as $key => $value){
            $tablesRows[$key-1]['id'] = $value['id'];
            $tablesRows[$key-1]['FIO'] = $value['fio'];
            $tablesRows[$key-1]['birthday'] = $value['birthday'];
            $tablesRows[$key-1]['city'] = $value['city'];
            $tablesRows[$key-1]['death'] = $value['death'];
        }

        return $tablesRows;

    }

    public static function delete($id)
    {
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        $authors = R::load('authors', $id);
        R::trash($authors);
    }

    public static function upp($id, $fio, $birthday, $death, $city)
    {
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        $authors = R::load('authors', $id);

        $authors->fio = $fio;
        $authors->birthday = $birthday;
        $authors->death = $death;
        $authors->city = $city;

        $book = R::store($authors);
        return true;
    }

    public static function add($fio, $birthday, $death, $city){

        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        $authors = R::dispense('authors');

        $authors->fio = $fio;
        $authors->birthday = $birthday;
        $authors->death = $death;
        $authors->city = $city;

        $book = R::store($authors);
        return true;
    }
}