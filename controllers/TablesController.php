<?php
require_once(ROOT . '/models/authors.php');
require_once(ROOT . '/models/books.php');
require_once(ROOT . '/models/genres.php');

class TablesController
{

    /**
     * Выборка по всем таблицам и вызов странички
     * @return bool
     */
    public function actionIndex(): bool
    {
        $authorTable = authors::getall();
        $booksTable = books::getall();
        $genresTable = genres::getall();
        if ($_POST) {
            $genre = mysqli_fetch_assoc(books::getGenre($_POST['Upper']));
            $author = mysqli_fetch_assoc(books::getAuthor($_POST['Upper']));
        }
        $tables = ['books' => $booksTable, 'authors' => $authorTable, 'genres' => $genresTable];
        require_once('Tables and books/index.php');
        return true;
    }

    /**
     * Изменение строк в таблицах и перенаправление на /
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
     * @return bool
     */
    public function actionDel(): bool
    {
        var_dump($_POST);
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
     * @return bool
     */
    public function actionAdd(): bool
    {
        var_dump($_POST);
        return True;
    }

}