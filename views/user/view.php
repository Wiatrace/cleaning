<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->id_user;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if(Yii::$app->user->identity->isAdmin()){
            echo Html::a(text: 'В работу', url: ['application/onprogress', 'application_id'=> $model->id],['class' => 'btn']);
            echo Html::a(text: 'Выполнить', url: ['application/finish', 'application_id'=> $model->id],['class' => 'btn']);
            echo Html::a(text: 'Отмена', url: ['rejection/create', 'application_id'=> $model->id],['class' => 'btn']);
        }
        else{
        Html::a('Update', ['update', 'id_user' => $model->id_user], ['class' => 'btn btn-primary']);
        Html::a('Delete', ['delete', 'id_user' => $model->id_user], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) 
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_user',
            'full_name',
            'username',
            'phone',
            'email:email',
            'password',
            'role_id',
        ],
    ]) ?>

</div>
