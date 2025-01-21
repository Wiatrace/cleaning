<?php
$this->registerJsFile(
    '@web/js/request.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
use yii\helpers\ArrayHelper;
use app\models\VidUslugi;
use app\models\application;
use app\models\Rejections;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
/** @var yii\web\View $this */
/** @var app\models\Application $model */
/** @var yii\widgets\ActiveForm $form */

$command = Yii::$app->db->createCommand("SHOW COLUMNS FROM application LIKE 'oplata'");
$row = $command->queryOne();
$enum = $row['Type'];
$enum = str_replace("set('", "", $enum);
$enum = str_replace("')", "", $enum);
$payment_types = [];
foreach (explode("','", $enum) as $value) $payment_types[$value] = $value;

$second_command = Yii::$app->db->createCommand("SHOW COLUMNS FROM application LIKE 'status'");
$second_row = $second_command->queryOne();
$second_enum = $second_row['Type'];
$second_enum = str_replace("set('", "", $second_enum);
$second_enum = str_replace("')", "", $second_enum);
$status = [];
foreach (explode("','", $second_enum) as $second_value) $status[$second_value] = $second_value;
?>

<div class="application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '+7(999)-999-99-99',
    ]) ?>

    <?= $form->field($model, 'vid_uslugi')->dropDownList(
            ArrayHelper::map(VidUslugi::find()->where(['<>', 'id_uslugi', 6])->orderBy('name')->all(),'id_uslugi','name')
    )?> 

    <?= $form->field($model, 'oplata')->dropDownList($payment_types) ?>
    <?= $form->field($model, 'time')->widget(\janisto\timepicker\TimePicker::className(), [
    'mode' => 'datetime',
    'clientOptions'=>[
        'dateFormat' => 'yy-mm-dd',
        'timeFormat' => 'HH:mm:ss',
        'showSecond' => false,
        'minDate' => '+1d',
    ]
    ]) ?>

    <div id="custom-service-container" class="d-none">
        <?= $form->field($model, 'other_usluga_description')->textarea(['rows' => 6,]) ?>
    </div>

    <?= $form->field($model, 'dop_usluga_check')->checkbox() ?>

    <?= $form->field($model, 'status')->hiddenInput(['rows' => 6,]) -> label(false)?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
