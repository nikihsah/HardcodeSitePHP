<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Boostrap and css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>

</head>
<body>

<!-- header -->
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <text class='logo'>PHPNikita
                    <text>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
                <li><a href="/colvogenre" class="nav-link px-2 text-white">Жанр-количество</a></li>
                <li><a href="/date" class="nav-link px-2 text-white">Книги за десятилетия</a></li>
                <li><a href="/procedure" class="nav-link px-2 text-white">Процедуры</a></li>
            </ul>

            <form method="POST" class="row" action="/slovo">
                <div class=" col-6">
                    <input type="text" name="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                </div>
                <div class=" col-6">
                    <input type="submit" class="btn btn-outline-light me-2 col-6" value="Найти">
                </div>
            </form>

            <?php
            session_start();
            if(!isset($_SESSION['user'])){

            ?>

            <div class="text-end">
                <a href="/login">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                </a>
                <a href="/singin">
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </a>
            </div>
            <?php
            }
            else{
                echo '<div class="text-end ">';
                echo sprintf("%s", $_SESSION['user']->getusername());
                ?>
                    <a href="/exit">
                        <button type="button" class="btn btn-warning btn-block btn-sm">Exit</button>
                    </a>
                </div>

            <?php
            }

            ?>
        </div>

    </div>
</header>