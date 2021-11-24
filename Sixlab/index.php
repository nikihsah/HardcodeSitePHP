
<?php if($_POST['index'] == 'Colvogenre'){?>
<section class="container-fluid">
    <div class="position-relative" style="text-align: center"><h3>Жанр_кол-во</h3></div>
    <table class='table'>
        <tr>
            <th>Жанр</th>
            <th>Кол-во</th>
        </tr>
        <?php foreach($table as $key => $value){?>
            <tr>
                <td><?=$value['genre']?></td>
                <td><?=$count[$key - 1]?></td>
            </tr>
        <?php }?>
    </table>
</section>
<?php } else{

foreach ($table as $key => $value) {
            ?><ul><li><?php echo $value->name. '('. $value->years. ')'. '</br>'; ?></li></ul><?php
        }

 }

