<?php
include(ROOT . '/includes/header.php') ?>

<!--Если POST пустой, мы выводим обычные таблицы, иначе таблицы для редактирования-->
<?php
if(!($_POST)){
?>
<!--    Всплывающее окно добавления-->
    <?php
    include_once(ROOT . '/Tables and books/modelicon.php')
    ?>

    <?php
    foreach($tables as $name => $table){
    ?>
        <section class="container-fluid">
            <div class="position-relative" style="text-align: center"><h3><?=$name?></h3></div>
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
                    <form action="del" method="POST">
                    <input type="hidden" value="%s" name="table" required >
                    <input type="hidden" value="%s" name="id" required >
                    <td><input
                    type="submit" class="btn btn-dark" value="Удалить"></td>
                    </tr>', $name, $name, $str['id']);
                }
                ?>
            </table>
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#<?=$name?>">
                Добавить запись
            </button>
            <hr size="20">
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
            <section class="container-fluid">
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
                            switch ($name) {

                                case "books":
                                    echo sprintf(
                                        '<form class="form-group" action="upper" method="POST">
                                                    <input name="table" value="books" type="hidden">
                                                    <input name="id" value="%s" type="hidden">
                                                    <td><input class="form-control" name="name" value="%s" type="text" required></td>
                                                    <td><input class="form-control" name="years" type="date" required></td>
                                                    <td><input class="form-control" name="description" value="%s" type="text" required></td>
				                                    <td><input class="form-control" name="city" value="%s" type="text" required></td>
                                                    <td><select class="form-control" name="FIO" required>',
                                        $str['id'], $str['name'], $str['description'], $str['city']);

                                    echo sprintf('<option value="%s">%s</option>',
                                        $author['id'], $author['FIO']);
                                    foreach($authorTable as $num => $row){
                                        if($author['id'] == $row['id']) {
                                            echo sprintf("<option value='%s'>%s</option>",
                                                $row['id'], $row['FIO']);
                                        }
                                    }
                                    echo'</td>';

                                    echo sprintf('<td><select class="form-control" name = "genres" required>
                                                         <option value="%s">%s</option>',
                                        $genre['id'], $genre['genre']);
                                    foreach($genresTable as $num => $row){
                                        if ($row['id'] != $genre['id']) {
                                            echo sprintf("<option value='%s'>%s</option>",
                                                $row['id'], $row['genre']);
                                        }
                                    }
                                    echo '</td>
                                          <td><input type="submit" value="Подтвердить" class="btn btn-dark"></td>
                                          <td><input type="reset" value="Вернуть" class="btn btn-dark"></td>
                                          </form>';
                                    break;

                                case 'genres':
                                    echo sprintf(
                                        '<form class="form-group" action="upper" method="POST">
                                                <input name="table" value="genres" type="hidden">
                                                <input name="id" value="%s" type="hidden">
                                                <td><input class="form-control" name = "genre" value="%s" type="text"></td>
                                                <td><input type="submit" value="Подтвердить" class="btn btn-dark"></td>
                                                <td><input type="reset" value="Вернуть" class="btn btn-dark"></td>
                                                </form>', $str['id'], $str['genre']);
                                    break;


                                case 'authors':
                                    echo sprintf(
                                        '<form class="form-group" action="upper" method="POST">
                                                <input name="table" value="genres" type="hidden">
                                                <input name="id" value="%s" type="hidden">
                                                <td><input class="form-control" name = "FIO" value="%s" type="text"></td>
                                                <td><input class="form-control" name = "birthday" type="date"></td>
                                                <td><input class="form-control" name = "city" value="%s" type="text"></td>
                                                <td><input class="form-control" name = "death" type="date"></td>
                                                <td><input type="submit" value="Подтвердить" class="btn btn-dark"></td>
                                                <td><input type="reset" value="Вернуть" class="btn btn-dark"></td>
                                                </form>', $str['id'], $str['FIO'], $str['city']);
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
                        echo '</tr>';
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