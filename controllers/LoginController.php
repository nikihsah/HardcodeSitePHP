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

                    if($_POST['cookie']){
                        setcookie('user', $user, time() + 3600 * 24 * 7);
                    }

                    header('Location: /');
                }
            }
            $_POST = 0;
        }

        require_once(ROOT . '/includes/header.php');
        require_once(ROOT . '/login/login.php');
        require_once(ROOT . '/includes/footer.php');
        return true;
    }

    public function actionLogout(): bool{
        session_start();
        unset($_SESSION['user']);
        setcookie('user', '', time()-1);
        header('Location: /');
        return true;
    }

    public function actionSingin(){
        $error = null;
        $users = user::getall();
        if($_POST){
            $error = 1;
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $error = 2;

                if (strlen($_POST['username'])>6){
                    $error = 3;
                    if( preg_match('#^\S*(?=\S{8,25})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#', $_POST['password'])){
                        $error = 0;
                        foreach ($users as $key => $value){
                            if($value['email'] != $_POST['email'] and $value['username'] != $_POST['username']){
                                $error = 4;
                            }
                        }
//                        (?=\S{12,25}): задает лимит паролю 12-25 символов
//                        (?=\S*[a-z]): содержит хотя бы одну маленькую букву
//                        (?=\S*[A-Z]): содержит хотя бы одну большую букву
//                        (?=\S*[\d]): и хотя бы одну цифру
                        if($error == 0) {
                            $user = new user($_POST['password'],
                                $_POST['email'], 0, $_POST['username'], 0);
                            $user->adduser();
                            header('Location: /login');
                        }
                    }
                }
            }
        }
        $_POST = $error;
        require_once(ROOT . '/includes/header.php');
        require_once(ROOT . '/login/singin.php');
        require_once(ROOT . '/includes/footer.php');
        return true;
    }

}