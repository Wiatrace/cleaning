<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Application $model */
?>
<h1><img id="image" src="https://cdn-icons-png.flaticon.com/128/11069/11069063.png" style="width:50px;height:50px;" data-size="512" class="img-responsive"><?= Html::encode($this->title = 'Создать заявку') ?></h1>
<div class="application-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
