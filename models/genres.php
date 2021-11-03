<?php


class genres
{
    public static function getall()
    {
        $connect = connect();
        return mysqli_query($connect,'SELECT genres.id, genres.genre From genres');
    }

    public static function delete($id)
    {
        $connect = connect();
        return mysqli_query($connect, "DELETE FROM genres WHERE id = '$id'");
    }

    public static function upp($id, $genre)
    {
        $connect = connect();
        return mysqli_query($connect, "UPDATE genres
        SET genre = '$genre'
        WHERE id = '$id'");
    }
}