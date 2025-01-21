<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Rejections;
use app\models\Application;
/** @var yii\web\View $this */
/** @var app\models\Rejections $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rejections-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'reason')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'request_id')->HiddenInput(['value' => $id_application]) ->label(false)?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
