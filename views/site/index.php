<?php

/** @var yii\web\View $this */

$this->title = 'Мой не Сам';
?>
<div class="site-index">

    <div class="jumbotron text-center align-middle">
        <h1 class="display-4">Добрый день</h1>
        <?php if (Yii::$app->user->isGuest) {
        echo '<p class="lead">Авторизоваться</p>';
        echo '<p><a class="btn btn-lg btn-success" href="https://opt-kuznetcov.xn--80ahdri7a.site/site/login">Вход</a></p>';
    } else if (Yii::$app->user->identity->isAdmin()){
        echo '<p class="lead">Панель администратора</p>';
        echo '<p><a class="btn btn-lg btn-success" href="https://opt-kuznetcov.xn--80ahdri7a.site/application">Панель администратора</a></p>';
    }
    else{
        echo '<p class="lead">Создать заявку</p>';
        echo '<p><a class="btn btn-lg btn-success" href="https://opt-kuznetcov.xn--80ahdri7a.site/application/create">Создать заявку</a></p>';
    }
    ?>
    <div class="img_dobro"><img class="img_dobro" src="https://avatars.mds.yandex.net/get-altay/7636462/2a00000185062637a5ce56ee71ac13dc1b01/XXL_height" alt=""></div>
    </div>

    </div>
</div>
