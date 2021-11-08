<?php
include ('user.php');

//бесполезное действо -_-
class SuperUser extends user
{
    private $rank;

    public function __construct($password, $email, $rank, $username, $id)
    {
        parent::__construct($password, $email, $rank, $username, $id);
        $this -> rank = 'admin';
    }

    public function getrank()
    {
        return $this->rank;
    }
}