<?php
include(ROOT . '/includes/header.php') ?>

    <!--Таблица авторов-->
    <section class="container">
        <h1>Сайт PHPNikita</h1>
        <div class="position-relative start-50"><h3>authors</h3></div>
        <table class='table'>
            <tr>
                <?php
                foreach (mysqli_fetch_assoc($authorTable) as $key => $value) {
                    if($key != 'id') {
                        echo sprintf('<th scope="row">%s</th>', $key);
                    }
                }
                ?>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($authorTable)) {
                echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $row['FIO'], $row['birthday'], $row['city'], $row['death']);
            }
            ?>
        </table>
    </section>

    <!--Таблица книг-->
    <section class="container">
        <h1>Сайт PHPNikita</h1>
        <div class="position-relative start-50"><h3>authors</h3></div>
        <table class='table'>
            <tr>
                <?php
                foreach (mysqli_fetch_assoc($authorTable) as $key => $value) {
                    if($key != 'id') {
                        echo sprintf('<th scope="row">%s</th>', $key);
                    }
                }
                ?>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($authorTable)) {
                echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $row['FIO'], $row['birthday'], $row['city'], $row['death']);
            }
            ?>
        </table>
    </section>
<?php
include(ROOT . '/includes/footer.php') ?>