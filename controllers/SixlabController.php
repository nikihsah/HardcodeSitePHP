<?php
require_once(ROOT . '/models/authors.php');
require_once(ROOT . '/models/books.php');
require_once(ROOT . '/models/genres.php');
require_once(ROOT . '/models/user.php');
require_once(ROOT . '/models/comments.php');
require_once(ROOT . '/models/user.php');
require_once(ROOT . '/rb.php');

class SixlabController
{
    public function actionColvogenre(){
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        $table = R::findAll('genres');

        foreach($table as $key => $value){
            $count[] = R::count('books', 'idauthor = ?', [$value->id]);
        }

        $_POST['index'] = 'Colvogenre';
        require_once(ROOT . '/includes/header.php');
        require_once(ROOT . '/Sixlab/index.php');
        require_once(ROOT . '/includes/footer.php');

        return true;
    }

    public function actionSlovo(){
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");

        $_POST['index'] = 'Slovo';
        $search = $_POST['search'];

        $result = R::findOne('books', 'name LIKE ?', ["%$search%"]);

        if(preg_match('~^([0-9]+)$~', $result->id)){
            header(sprintf("Location: /%s", $result->id));
        }else{
            header("Location: /");
        };

        return true;
    }

    public function actionDate(){
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");

        $table = R::find('books', 'years > ?', array('2011-01-01 00:00:00'));

        $_POST['index']='0';
        require_once(ROOT . '/includes/header.php');
        require_once(ROOT . '/Sixlab/index.php');
        require_once(ROOT . '/includes/footer.php');

        return true;
    }
}