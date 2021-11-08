<?php
include_once(ROOT . '/models/user.php');
include_once (ROOT . '/models/Session.php');

class LoginController
{
    public function actionLogging(): bool
    {
        $userTables = user::getall();
        if($_POST){
            $local = 0;
            foreach ($userTables as $row => $users){
                if($users['username'] == $_POST['username'] and $users['password'] == $_POST['password']){
                    $user = new user($users['password'],
                        $users['email'],
                        $users['rank'],
                        $users['username'],
                        $users['id']);
                    $session = new Session($user);
                    $_SESSION['user'] = $user;
                    header('Location: /');
                }
            }
            $_POST = 0;
        }

        require_once(ROOT . '/includes/header.php');
        require_once(ROOT . 'login/login.php');
        require_once(ROOT . '/includes/footer.php');
        return true;
    }

    public function actionLogout(): bool{
        session_start();
        unset($_SESSION['user']);
        header('Location: /');
        return true;
    }

    public function actionSingin(){
        require_once(ROOT . '/includes/header.php');
        require_once(ROOT . 'login/login.php');
        require_once(ROOT . '/includes/footer.php');
    }

}