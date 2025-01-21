<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rejections $model */

$this->title = 'Update Rejections: ' . $model->request_id;
$this->params['breadcrumbs'][] = ['label' => 'Rejections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->request_id, 'url' => ['view', 'request_id' => $model->request_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rejections-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
