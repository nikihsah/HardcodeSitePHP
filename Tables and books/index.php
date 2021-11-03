<?php
include(ROOT . '/includes/header.php') ?>
<!--Кнопка-->
<?php
$button = "<td><button type='submit' class='btn btn-dark' form='upper'>Изменить</button></td><td><button
 type='submit' class='btn btn-dark'>Удалить</button></td>";
$formUpp = '<form action="" method="POST" id="upper"><input type="hidden" value="%s"></form>';
var_dump(count($_POST));
?>

    <!--Таблица книг-->
    <section class="container">
        <div class="position-relative start-50"><h3>books</h3></div>
        <table class='table'>
            <tr>
                <?php
                foreach ($booksTable[0] as $key => $value) {
                    if (!preg_match( "#\w{0,}(id)#", $key)) {
                            echo sprintf('<th scope="row">%s</th>', $key);
                    }
                }
                ?>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            <?php
            foreach ($booksTable as $numberstr => $str) {
                echo '<tr>';
                foreach ($str as $key => $value)
                    if (!preg_match('#\w{0,}(id)#', $key)) {
                        echo sprintf('<td>%s</td>', $value);
                    }
                    elseif($key == 'id'){
                        echo sprintf($formUpp, $value);
                    }
                echo sprintf('%s</tr>',$button);
            }
            ?>
        </table>
    </section>

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
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($authorTable)) {
                echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td>%s</tr>', $row['FIO'], $row['birthday'], $row['city'], $row['death'], $button);
            }
            ?>
        </table>
    </section>

    <!--Таблица книг-->
    <section class="container">
        <div class="position-relative start-50"><h3>genres</h3></div>
        <table class='table'>
            <tr>
                <?php
                foreach (mysqli_fetch_assoc($genresTable) as $key => $value) {
                    if($key != 'id') {
                        echo sprintf('<th scope="row">%s</th>', $key);
                    }
                }
                ?>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($genresTable)) {
                echo sprintf('<tr><td>%s</td>%s</tr>', $row['genre'], $button);
            }
            ?>
        </table>
    </section>
<?php
include(ROOT . '/includes/footer.php') ?>