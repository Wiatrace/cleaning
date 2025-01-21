<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rejections".
 *
 * @property string $reason
 * @property int $request_id
 *
 * @property Application $request
 */
class Rejections extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rejections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reason', 'request_id'], 'required'],
            [['reason'], 'string'],
            [['request_id'], 'integer'],
            [['request_id'], 'unique'],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::class, 'targetAttribute' => ['request_id' => 'id_application']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'reason' => 'Reason',
            'request_id' => 'Request ID',
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Application::class, ['id_application' => 'request_id']);
    }
}
