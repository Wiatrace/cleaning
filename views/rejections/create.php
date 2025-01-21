<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rejections $model */

$this->title = 'Create Rejections';
$this->params['breadcrumbs'][] = ['label' => 'Rejections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rejections-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id_application' => $id,
            ]) ?>

</div>
