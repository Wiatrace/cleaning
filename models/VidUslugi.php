<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vid_uslugi".
 *
 * @property int $id_uslugi
 * @property string $name
 *
 * @property Application[] $applications
 */
class VidUslugi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vid_uslugi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_uslugi' => 'Id Uslugi',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['vid_uslugi' => 'id_uslugi']);
    }
}
