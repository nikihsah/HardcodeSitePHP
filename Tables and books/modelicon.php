<?php
foreach($tables as $name => $table){
    ?>
    <div class="modal fade" id="<?=$name?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить в таблицу <?=$name?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" id="<?=$name?>add" action="/add" method="POST">
                        <?php
                        switch ($name){

//                            __________________________BOOKS_________________
                            case 'books':
                                ?>
                                <input type="hidden" value="<?=$name?>" name="table" required >

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Название книги</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="name" type="text" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Дата написания</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="years" type="date" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Описание книги</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="description" type="text" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Город</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="city" type="text" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Автор</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="FIO">
                                            <?php
                                            foreach($authorTable as $num => $row){
                                                echo sprintf("<option value='%s'>%s</option>",
                                                    $row['id'], $row['FIO']);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Жанр</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="genre">
                                            <?php
                                            foreach($genresTable as $num => $row){
                                                echo sprintf("<option value='%s'>%s</option>",
                                                    $row['id'], $row['genre']);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            <?php
                                break;

//                                ___________________________GENRES______________________
                            case 'genres':?>

                                <input type="hidden" value="<?=$name?>" name="table" required >

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Жанр</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="genre" type="text" required>
                                    </div>
                                </div>

                            <?php
                                break;

//                                ______________________________AUTHORS____________________
                            case 'authors':?>

                                <input type="hidden" value="<?=$name?>" name="table" required >

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">ФИО</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="name" type="text" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Дата рождения</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="birthday" type="date" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">ФИО</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="city" type="text" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-4 col-form-label">Дата рождения</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="death" type="date" required>
                                    </div>
                                </div>

                            <?php
                        }
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <input form="<?=$name?>add" type="submit" class="btn btn-primary" value="Сохранить">
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>