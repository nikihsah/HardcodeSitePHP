<?php
$not = null;
return array(
    '^([0-9]+)$' => 'books/book',

    'del' => 'tables/del',
	'upper' => 'tables/upper',
    'add' => 'tables/add',

	'login' => 'login/logging',
    'exit' => 'login/logout',
    'singin' => 'login/singin',

    "$not" => 'tables/index',
);
