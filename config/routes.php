<?php
$not = null;
return array(
    '^([0-9]+)$' => 'tables/book',

    'del' => 'tables/del',
	'upper' => 'tables/upper',
    'add' => 'tables/add',
    'test' => 'tables/test',

	'login' => 'login/logging',
    'exit' => 'login/logout',
    'singin' => 'login/singin',

    "$not" => 'tables/index',
);
