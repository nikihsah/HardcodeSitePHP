<section class="container-fluid">
    <div class="position-relative" style="text-align: center"><h3>Задание 1</h3></div>
    <table class='table'>
        <tr>
            <th>Жанр</th>
            <th>Кол-во</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($first)){?>
            <tr>
                <td><?=$row['genre']?></td>
                <td><?=$row['colvo']?></td>
            </tr>
        <?php }?>
    </table>
</section>

<section class="container-fluid">
    <div class="position-relative" style="text-align: center"><h3>Задание 2,3,4</h3></div>
    <form class="row" action="" method="post">
        <div class="col-lg-2">
            <input class="form-control" name='strForProcedure' type="text">
        </div>
        <div class="col-lg-2">
            <input class="btn btn-secondary" type="submit">
        </div>
    </form>
</section>

<?php if (isset($_POST['strForProcedure'])){?>
    <section class="container-fluid">
        <?php if(isset($_POST['second']) and $_POST['second']){?>
            <table class='table'>
                <tr>
                    <?php
                        while($row = mysqli_fetch_assoc($second)){
                            foreach ($row as $key => $value) {
                                echo sprintf('<td>%s</td>', $value);
                            }
                        }
                    ?>
                </tr>
            </table>
        <?php }
        if(isset($_POST['third']) and $_POST['third']){?>
            <table class='table'>
                <tr>
                    <?php
                    while($row = mysqli_fetch_assoc($third)){
                        foreach ($row as $key => $value){
                            echo sprintf('<td>%s</td>', $value);

                        }
                    }?>
                </tr>
            </table>
        <?php }
        if(isset($_POST['fourth']) and $_POST['fourth']){?>
            <table class='table'>
                <tr>
                    <?php
                    while($row = mysqli_fetch_assoc($fourth)){
                        foreach ($row as $key => $value){
                            echo sprintf('<td>%s</td>', $value);

                        }
                    }?>
                </tr>
            </table>
    </section>

<?php }
}?>