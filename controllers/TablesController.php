<?php
require_once(ROOT . '/models/authors.php');
require_once(ROOT . '/models/books.php');
require_once(ROOT . '/models/genres.php');

class TablesController
{
    public function actionIndex(): bool
    {
        $authorTable = authors::getall();
        $booksTable = books::getall();
        $genresTable = genres::getall();
        $tables = ['books' => $booksTable, 'authors' => $authorTable, 'genres' => $genresTable];
        require_once('Tables and books/index.php');
        return true;
    }

    public function actionUpper(): bool
    {
        return TRUE;
    }
}