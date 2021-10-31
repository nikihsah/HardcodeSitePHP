<?php
// fron controller

//1 Настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

//2 подключение файлов к системе
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/Components/Router.php');

//3 Установка соеденения с бд
$server = 'localhost'; 
$username = 'root'; 
$password = '';
$dbname = 'biblio';

$connect = mysqli_connect($server, $username, $password, $dbname); 
mysqli_select_db($connect, $dbname);


//4 Вызов Route
$route = new Router();
$route->run();


?>