<?php
function connect()
{
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'biblio';

    $connect = mysqli_connect($server, $username, $password, $dbname);
    mysqli_select_db($connect, $dbname);
    return $connect;
}