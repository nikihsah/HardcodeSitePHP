<?php
require ('rb.php');

function connect()
{
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'biblio';



    $connect = mysqli_connect('localhost', 'root', '', 'biblio');

    return $connect;
}