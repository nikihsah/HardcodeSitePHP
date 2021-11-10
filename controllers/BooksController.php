<?php
include(ROOT . '/models/comments.php');
include(ROOT . '/models/books.php');
include(ROOT . '/models/user.php');

class BooksController
{

    public function actionBook(){

        $id = trim($_SERVER['REQUEST_URI'], '/');

        $comm = new comments($id);

        $book = books::get($id);

        if(isset($_POST['idUser'])){
            $comm->addcomment($_POST['idUser'], $_POST['text']);
            header("Location: ".$_SERVER['REQUEST_URI']);
        }

        $all = $comm->getcomments();

        require_once(ROOT . '/includes/header.php');
        include(ROOT . '/book/view.php');
        require_once(ROOT . '/includes/footer.php');

        return true;
    }

}