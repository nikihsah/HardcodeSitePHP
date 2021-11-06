<?php
include(ROOT . '/includes/header.php') ?>
<!--Кнопка-->
<?php
var_dump($_POST);
?>

<!--Если POST пустой, мы выводим обычные таблицы, иначе таблицы для редактирования-->
<?php
if(!($_POST)){
?>

    <?php
    foreach($tables as $name => $table){
    ?>
        <section class="container">
            <div class="position-relative start-50"><h3><?=$name?></h3></div>
            <table class='table'>
                <tr>
<!--                         Название столбцов -->
                    <?php
                    foreach ($table[0] as $key => $value) {
                        if (!preg_match( "#\w{0,}(id)#", $key)) {
                            echo sprintf('<th scope="row">%s</th>', $key);
                        }
                    }
                    ?>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>

<!--                    Cтолбцы-->
                <?php
                foreach ($table as $numberstr => $str) {
                    echo '<tr>';
                    foreach ($str as $key => $value)
                        if (!preg_match('#\w{0,}(id)#', $key)) {
                            echo sprintf('<td>%s</td>', $value);
                        }
                        elseif($key == 'id'){
                            echo sprintf('<form action="" method="POST" ><input
                        type="hidden" value="%s" name="Upper" required >', $value);
                        }
                    echo sprintf('<input type="hidden" value="%s" name="table" required >
                    <td><input type="submit" class="btn btn-dark" value="Изменить" ></form>
                    <td><button
                    type="submit" class="btn btn-dark">Удалить</button></td>
                    </tr>', $name);
                }
                ?>
            </table>
        </section>
    <?php
    }
    ?>


<?php
}
else{
?>
<!------------Если POST пустой, мы выводим обычные таблицы, иначе таблицы для редактирования--------------------------->

    <?php
    foreach($tables as $name => $table){?>
            <section class="container">
                <div class="position-relative start-50"><h3><?=$name?></h3></div>
                <table class='table'>

                    <tr>
<!--                         Название столбцов -->
                        <?php
                        foreach ($table[0] as $key => $value) {
                            if (!preg_match( "#\w{0,}(id)#", $key)) {
                                echo sprintf('<th scope="row">%s</th>', $key);
                            }
                        }
                        ?>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>

<!--                    Cтолбцы-->
                    <?php
                    foreach ($table as $numberstr => $str) {
                        echo '<tr>';

                        if($_POST['table'] = $table and $str['id'] == $_POST['Upper']){

                            switch ($_POST['table']) {

                                case 'books':
                                    echo sprintf(
                                        '<form action="/upper" method="POST">
                                                    <td><input name="name" placeholder="%s" type="text" required></td>
                                                    <td><input name="years" placeholder="%s" type="date" required></td>
                                                    <td><input name="description" placeholder="%s" type="text" required></td>
				                                    <td><input name="city" placeholder="%s" type="text"  required></td>
                                                    ',
                                        $str['name'], $str['years'], $str['description'], $str['city']
                                    );
                                    break;

                                case 'genres':

                                case 'authors':

                            }
                        }
                        else{
                            foreach ($str as $key => $value) {
                                if (!preg_match('#\w{0,}(id)#', $key)) {
                                    echo sprintf('<td>%s</td>', $value);
                                }
                            }
                            echo '<td>-</td><td>-</td>';
                        }
                    }
                    ?>
                </table>
            </section>
        <?php
    }
    ?>
<?php
}
?>
<?php
include(ROOT . '/includes/footer.php') ?>