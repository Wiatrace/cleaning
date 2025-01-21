<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */
?>
<h1><img id="image" style="width:50px;height:50px;" data-size="512" 
class="img-responsive" src="https://cdn-icons-png.flaticon.com/128/1077/1077012.png">
<?= Html::encode($this->title = 'Регистрация') ?></h1>
</h1>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
