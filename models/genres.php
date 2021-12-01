<?php


class genres
{
    public static function getall()
    {
//        $connect = connect();
//        $result = mysqli_query($connect,'SELECT genres.id, genres.genre From genres');
//        while ($row = mysqli_fetch_assoc($result)) {
//            $tablesRows[] = $row;
//        }

        $table = $genre = R::findAll('genres');

        foreach($table as $key => $value){
            $tablesRows[$key-1]['id'] = $value['id'];
            $tablesRows[$key-1]['genre'] = $value['genre'];
            $tablesRows[$key-1]['colvo'] = $value['colvo'];
        }

        return $tablesRows;
    }

    public static function delete($id)
    {
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        $table = R::load('genres', $id);
        R::trash($table);
    }

    public static function upp($id, $genre)
    {
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        $genres = R::load('genres', $id);

        $genres->genre = $genre;

        $genres = R::store($genres);
        return true;
    }

    public static function add($genre){

        $genres = R::dispense('genres');

        $genres->genre = $genre;

        $genres = R::store($genres);
        return true;
    }
}