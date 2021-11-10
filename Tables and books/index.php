<!--Если POST пустой, мы выводим обычные таблицы, иначе таблицы для редактирования-->
<?php
if(!($_POST)) {
    ?>
    <?php
    foreach ($tables as $name => $table) {
        ?>
        <section class="container-fluid">
            <div class="position-relative" style="text-align: center"><h3><?= $name ?></h3></div>
            <table class='table'>
                <tr>
                    <!--                         Название столбцов -->
                    <?php
                    foreach ($table[0] as $key => $value) {
                        if(!preg_match("#\w{0,}(id)#", $key)) {
                            echo sprintf('<th scope="row">%s</th>', $key);
                        }
                    }
                    ?>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>

                <!--________________Cтолбцы_______________________-->
                <?php
                foreach ($table as $numberstr => $str) {
                    echo '<tr>';
                    $idd = $str['id'];
                    foreach ($str as $key => $value)
                        if(!preg_match('#\w{0,}(id)#', $key)) {
                            if($name=='books') {
                                echo sprintf("<td><a href='$idd'>%s</a></td>", $value);
                            }else{
                                echo sprintf("<td>%s</td>", $value);
                            }
                        }

                    if(!isset($_SESSION['user'])) {
                        echo '</form><td>Войдите</td><td>Войдите</td></tr>';
                    }elseif($_SESSION['user']->getrank()==1) {
                        echo sprintf('
                            <td><form action="" method="POST" >
                            <input type="hidden" name="method" value="upp">
                            <input type="hidden" value="%s" name="id" required >
                            <input  type="hidden" value="%s" name="table" required >
                            <input  type="submit"  class="btn btn-dark" value="Изменить" ></td>
                            </form>
                            <td>
                            <form action="del" method="POST">
                            <input type="hidden" value="%s" name="id" required >
                            <input  type="hidden" value="%s" name="table" required >
                            <input type="submit" formaction="del" class="btn btn-dark" value="Удалить">
                            </form>
                            </td>
                            </tr>',$str['id'], $name, $name, $str['id']);
                    }else{
                        echo'</form><td>Недоступно</td><td>Недоступно</td></tr>';
                    }

                }
                ?>
            </table>

<!--            _______________________Добавление записи__________________-->
            <?php
            if(!isset($_SESSION['user'])) {
                echo '<div class="text-danger">Для добавления записи войдите на сайт</div>';
            }elseif($_SESSION['user']->getrank()==0){
                echo '<div class="text-danger">Операция добавления недоступна</div>';
            }else{?>

            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#<?= $name ?>">
                Добавить запись
            </button>
            <hr size="20">
            <?php }?>

        </section>
        <?php
    }
    ?>


    <?php
} else {
    ?>
    <!------------Если POST пустой, мы выводим обычные таблицы, иначе таблицы для редактирования--------------------------->

    <?php
    foreach ($tables as $name => $table) {
        ?>
        <section class="container-fluid">
            <div class="position-relative start-50"><h3><?= $name ?></h3></div>
            <table class='table'>

                <tr>
                    <!--                         Название столбцов -->
                    <?php
                    foreach ($table[0] as $key => $value) {
                        if(!preg_match("#\w{0,}(id)#", $key)) {
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

                    if($_POST['table'] == $name and $str['id'] == $_POST['id']) {
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
                                foreach ($authorTable as $num => $row) {
                                    if(!($author['id'] == $row['id'])) {
                                        echo sprintf("<option value='%s'>%s</option>",
                                            $row['id'], $row['FIO']);
                                    }
                                }
                                echo '</td>';

                                echo sprintf('<td><select class="form-control" name = "genres" required>
                                                         <option value="%s">%s</option>',
                                    $genre['id'], $genre['genre']);
                                foreach ($genresTable as $num => $row) {
                                    if($row['id'] != $genre['id']) {
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
                    } else {
                        foreach ($str as $key => $value) {
                            if(!preg_match('#\w{0,}(id)#', $key)) {
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