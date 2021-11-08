<?php


class Session
{

    public function __construct($user)
    {
        session_start();
        $_SESSION['user'] = $user;
    }

}