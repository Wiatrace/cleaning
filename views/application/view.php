<?php
 
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\rejections;
/** @var yii\web\View $this */
/** @var app\models\Application $model */
$this->title=$model->id_application;
?>
<div class="application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        if(Yii::$app->user->identity->isAdmin()){
            echo Html::a('В работу',['application/onprogress', 'id_application'=> $model->id_application],['class' => 'btn btn-success right']);
            echo Html::a('Выполнено', ['application/finish', 'id_application'=> $model->id_application],['class' => 'btn btn-primary right']);
            echo Html::a('Отмена', ['rejections/create', 'id_application'=> $model->id_application],['class' => 'btn btn-danger']);
        }
        else{
        Html::a('Update', ['update', 'id_user' => $model->user_id], ['class' => 'btn btn-primary']);
        Html::a('Delete', ['delete', 'id_user' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]); 
        }
        ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
            'attribute' => 'user_id' ,
            'visible' => Yii::$app->user->identity->isAdmin(),
            ],
            'address',
            'phone_number',
            [
                'label' => 'Вид услуги',
                'value' => @$model->vidUslugi->name,
            ],
            'other_usluga_description',
            'oplata',
            'time',
            'create_time',
            'status',
            [
            'label' => 'Причина',
            'value' => @$model->rejection->reason,
            ]
        ],
    ]) ?>

</div>
