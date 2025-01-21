<?php

use app\models\Rejections;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RejectionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rejections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rejections-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rejections', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'reason:ntext',
            'request_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rejections $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'request_id' => $model->request_id]);
                 }
            ],
        ],
    ]); ?>


</div>
