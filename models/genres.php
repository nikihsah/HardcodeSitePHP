<?php


class genres
{
    public static function getall()
    {
        $connect = connect();
        $result = mysqli_query($connect,'SELECT genres.id, genres.genre From genres');
        while ($row = mysqli_fetch_assoc($result)) {
            $tablesRows[] = $row;
        }
        return $tablesRows;
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