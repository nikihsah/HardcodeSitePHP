<?php
require_once(ROOT . '/models/authors.php');
require_once(ROOT . '/models/books.php');
require_once(ROOT . '/models/genres.php');
require_once(ROOT . '/models/user.php');
require_once(ROOT . '/models/comments.php');
require_once(ROOT . '/models/user.php');
require_once(ROOT . '/rb.php');

class SevenlabController
{
    public function actionProcedure(){

        $connect = connect();

        $first = mysqli_query($connect, 'CALL ex1');

        if(isset($_POST['strForProcedure'])) {

            $mysql = new mysqli( $server = 'localhost', $username = 'root', $password = '', $dbname = 'biblio');
            $query = sprintf("CALL `ex2`('%s');", $_POST['strForProcedure']);
            $second = $mysql->query($query);
            if($second) {
                $_POST['second'] = $second;
            }

            $mysql = new mysqli( $server = 'localhost', $username = 'root', $password = '', $dbname = 'biblio');
            $query = sprintf("CALL `ex3`('%s');", $_POST['strForProcedure']);
            $third = $mysql->query($query);
            if($third) {
                $_POST['third'] = $third;
            }

            $mysql = new mysqli( $server = 'localhost', $username = 'root', $password = '', $dbname = 'biblio');
            $query = sprintf("CALL `ex4`('%s');", $_POST['strForProcedure']);
            $fourth = $mysql->query($query);
            if($fourth) {
                $_POST['fourth'] = $fourth;
            }
        }
        require_once(ROOT . '/includes/header.php');
        require_once(ROOT . '/Sevenlab/index.php');
        require_once(ROOT . '/includes/footer.php');

        return true;
    }
}