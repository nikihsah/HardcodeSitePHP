<?php


class Flash
{

    public function getMessage()
    {
        return $_SESSION['message'];
    }

    public function setMessage($Message): void
    {
        $_SESSION['message'] =  $Message;
    }
}