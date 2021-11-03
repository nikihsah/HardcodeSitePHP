<?php
require_once (ROOT.'/models/authors.php');

class TablesController
{
    public function actionIndex()
    {
        $authorTable = authors::getall();
        require_once('Tables and books/index.php');

    }
}