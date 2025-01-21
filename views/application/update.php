<?php

use yii\helpers\Html;
use yii\models\Application;
/** @var yii\web\View $this */
/** @var app\models\Application $model */

$this->title = 'Update Application: ' . $model->id_application;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_application, 'url' => ['view', 'id' => $model->id_application]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="application-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
