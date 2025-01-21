<?php

use app\models\Application;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use Yii;
/** @var yii\web\View $this */
/** @var app\models\ApplicationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<h1><img id="image" style="width:50px;height:50px;" data-size="512" class="img-responsive" 
src="https://cdn-icons-png.flaticon.com/128/942/942748.png">
<?= Html::encode($this->title = 'Заявки') ?></h1>
<?php echo Html::a('Создать заявку',['application/create'],['class' => 'btn btn-success'])?>
<div class="application-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id' ,
                'visible' => Yii::$app->user->identity->isAdmin(),
            ],
            'address',
            'phone_number',
            [
                'attribute' => 'vid_uslugi',
                'value' => 'vid_uslugi.name',
            ],
            'other_usluga_description',
            'oplata',
            'time',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Application $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id_application]);
                 },
                 'template' => '{view}'
            ],
        ],
    ]); ?>


</div>
