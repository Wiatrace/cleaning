<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id_application
 * @property int $user_id
 * @property string $address
 * @property string $phone_number
 * @property int $vid_uslugi
 * @property string $other_usluga_description
 * @property string $oplata
 * @property string $time
 * @property string $create_time
 * @property string $status
 * @property int|null $rejection_Id
 *
 * @property Rejections $rejection
 * @property User $user
 * @property VidUslugi $vidUslugi
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'vid_uslugi', 'oplata', 'status'], 'required'],
            ['address', 'required', 'message'=>'Поле адрес не может быть пустым'],
            ['phone_number', 'required', 'message'=>'Поле номер телефона не может быть пустым'],
            ['time', 'required', 'message'=>'Поле время уборки не может быть пустым'],
            ['other_usluga_description', 'required', 'message'=>'Поле описание иной услуги не может быть пустым'],
            [['user_id','vid_uslugi', 'rejection'], 'integer'],
            ['vid_uslugi', 'match', 'pattern' => '/^[^1]\d*$/', 'message' => "Выберите услугу."],
            [['oplata', 'status'], 'string'],
            [['time', 'create_time'], 'safe'],
            [['dop_usluga_check'],'safe'],
            [['address', 'phone_number', 'other_usluga_description'], 'string', 'max' => 255],
            ['phone_number', 'match', 'pattern' => '/^\+7\(\d{3,}\)\-\d{3,}-\d{2,}-\d{2,}$/'],
            ['other_usluga_description', 'required', 'when' => function ($model) {
                return boolval($model->dop_usluga_check);
            }, 'whenClient' => "function (attribute, value) {
                let result = jQuery('#request-dop_usluga_check')[0].checked;
                return result;
            }"],
        ['dop_usluga_check', 'boolean'],
            [['vid_uslugi'], 'exist', 'skipOnError' => true, 'targetClass' => VidUslugi::class, 'targetAttribute' => ['vid_uslugi' => 'id_uslugi']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id_user']],
            [['rejection'], 'exist', 'skipOnError' => true, 'targetClass' => Rejections::class, 'targetAttribute' => ['rejection' => 'id_rejections']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_application' => 'Номер заявки',
            'user_id' => 'id пользователся',
            'address' => 'Адрес',
            'phone_number' => 'Номер телефона',
            'vid_uslugi' => 'Вид услуги',
            'dop_usluga_check' => 'Дополнительная услуга',
            'other_usluga_description' => 'Описание дополнительной услуги',
            'oplata' => 'Оплата',
            'time' => 'Время уборки',
            'create_time' => 'Время создания заявки',
            'status' => 'Статус заявки',
            'rejection' => 'Причина отказа',
        ];
    }

    /**
     * Gets query for [[Rejection]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRejection()
    {
        return $this->hasOne(Rejections::class, ['request_id' => 'id_application']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id_user' => 'user_id']);
    }

    /**
     * Gets query for [[VidUslugi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVidUslugi()
    {
        return $this->hasOne(VidUslugi::class, ['id_uslugi' => 'vid_uslugi']);
    }
}
