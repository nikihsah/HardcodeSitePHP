<?php
require_once(ROOT . '/models/authors.php');
require_once(ROOT . '/models/books.php');
require_once(ROOT . '/models/genres.php');
require_once(ROOT . '/models/user.php');
require_once(ROOT . '/models/comments.php');
require_once(ROOT . '/models/user.php');
require_once(ROOT . '/rb.php');

class TablesController
{

    /**
     * Выборка по всем таблицам и вызов странички
     *
     * @return bool
     */
    public function actionIndex(): bool
    {
        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        // -- vv----------ВЫБОРКА ИЗ ТАБЛИЦ---------------$authorTable = authors::getall();
        $booksTable = books::getall();
        $genresTable = genres::getall();
        $authorTable = authors::getall();
        if($_POST) {
            $genre = mysqli_fetch_assoc(books::getGenre($_POST['id']));
            $author = mysqli_fetch_assoc(books::getAuthor($_POST['id']));
        }
        $tables = ['books' => $booksTable, 'authors' => $authorTable, 'genres' => $genresTable];
//        ________САЙТ_______
        require_once(ROOT . '/includes/header.php');
        require_once(ROOT . '/Tables and books/modelicon.php');
        require_once(ROOT . '/Tables and books/index.php');
        require_once(ROOT . '/includes/footer.php');

        return true;
    }

    /**
     * Изменение строк в таблицах и перенаправление на /
     *
     * @return bool
     */
    public function actionUpper(): bool
    {
        switch ($_POST["table"]) {

            case 'books':
                books::upp($_POST['id'], $_POST['FIO'], $_POST['genres'], $_POST['name'], $_POST['city'], $_POST['years'], $_POST['description']);
                header('Location: /');
                return true;
                break;

            case 'genres':
                var_dump($_POST);
                genres::upp($_POST['id'], $_POST['genre']);
                header('Location: /');
                return true;
                break;

            case 'authors':
                authors::upp($_POST['id'], $_POST['FIO'], $_POST['birthday'], $_POST['death'], $_POST['city']);
                header('Location: /');
                return true;
                break;
        }
        return TRUE;
    }

    /**
     * Удаление строк в таблицах и перенаправление на /
     *
     * @return bool
     */
    public function actionDel(): bool
    {
        switch ($_POST["table"]) {

            case 'books':
                books::delete($_POST['id']);
                header('Location: /');
                return true;
                break;

            case 'genres':
                var_dump($_POST);
                genres::delete($_POST['id']);
                header('Location: /');
                return true;
                break;

            case 'authors':
                authors::delete($_POST['id']);
                header('Location: /');
                return true;
                break;
        }
        return TRUE;
    }

    /**
     * Добавление строк в таблицах и перенаправление на /
     *
     * @return bool
     */
    public function actionAdd(): bool
    {
        var_dump($_POST);
        switch ($_POST["table"]) {

            case "books":
                books::addBooks($_POST['name'], $_POST['years'], $_POST['description'], $_POST['city'], $_POST['FIO'], $_POST['genre']);
                header('Location: /');
                return true;

            case "genres":
                var_dump($_POST);
                genres::add($_POST['genre']);
                header('Location: /');
                return true;

            case "authors":
                authors::add($_POST['fio'], $_POST['birthday'], $_POST['death'], $_POST['city']);
                header('Location: /');
                return true;
        }


        return TRUE;
    }

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

    public function actionTest(){

        R::setup('mysql:host=127.0.0.1:3307; dbname=biblio','root', "");
        $connection = R::testConnection();

        $table = R::findAll('books');
        foreach($table as $key => $value){
            $tablesRows[$key-1]['id'] = $value['id'];
            $tablesRows[$key-1]['name'] = $value['name'];
            $tablesRows[$key-1]['years'] = $value['years'];
            $tablesRows[$key-1]['description'] = $value['description'];
            $tablesRows[$key-1]['city'] = $value['city'];

            $tablesRows[$key-1]['authorid'] = $value['idauthor'];
            $autho = R::find('authors', $value['idauthor']);
            $tablesRows[$key-1]['FIO'] = $autho[1]['fio'];

            $tablesRows[$key-1]['genreid'] = $value['idgenre'];
            $autho = R::find('genres', $value['idgenre']);
            $tablesRows[$key-1]['genre'] = $autho[1]['genre'];
        }
        var_dump($tablesRows);
        return True;
    }
}