
<section class="container-fluid">
    <div class="row mb-3">
        <div class="row">
            <h3><?=$book[0]['name']?></h3>
            <text><?=$book[0]['genre']?></text>
        </div>
        <div class="row">
            <h5><?=$book[0]['description']?></h5>
        </div>
        <div class="row">
            <text><?=$book[0]['FIO']?></text>
        </div>
    </div>
    <div class="row mb-3">

        <?php
        if($all){
            echo '<h5>Коментарии:</h5><hr>';
            foreach ($all as $number => $com){
                echo sprintf('<div class="row"><b>%s</b>', $com['username']);
                echo sprintf('<text>%s</text></div><hr>', $com['text']);
            }
        }else{
            echo '<h5>Коментарии не найдены, станьте первым!</h5>';
        }
        ?>

    </div>

    <div>
        <?php
        if(isset($_SESSION['user'])){
            echo sprintf("<form class='form-group mb-3' method='POST' action=''>
            <input name='idUser' type='hidden' value='%s'>
            <textarea class='form-control' name='text'></textarea>
            <input type='submit' class='btn btn-dark' value='Оставить'>
            </form>", $_SESSION['user']->getid());
        }
        ?>
    </div>

</section>