<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $full_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $consent
 * @property int $admin
 *
 * @property Problem[] $problems
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password_repetition;
    public function isAdmin()
    {
    if(Yii::$app->user->identity->role_id == 1)
    {    
    return 0;
    }
    else{
    return 1;
    }
    } 
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['full_name', 'required', 'message'=>'Поле ФИО не может быть пустым'],
            ['username', 'required', 'message'=>'Поле имя пользователя не может быть пустым'],
            ['phone', 'required', 'message'=>'Поле телефон не может быть пустым'],
            ['email', 'required', 'message'=>'Поле почта не может быть пустым'],
            ['password', 'required', 'message'=>'Поле пароль не может быть пустым'],
            ['password_repetition', 'required', 'message'=>'Поле повтор пароль не может быть пустым'],
            ['full_name', 'match', 'pattern' => '/^[а-яё\s\-]+$/iu', 'message'=>'Только кириллица,
           пробелы и дефисы'],
            ['username', 'match', 'pattern' => '/^[a-z]+$/iu', 'message'=>'Только латиница'],
            ['email', 'email'],
            ['password_repetition', 'compare', 'compareAttribute' => 'password', 'message'=>'Пароли
           должны совпадать'],
            [['role_id'], 'integer'],
            [['full_name', 'username', 'email', 'password'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'ID',
            'full_name' => 'ФИО (кириллица и пробел)',
            'username' => 'Логин (латиница)',
            'phone' => 'Телефон',
            'email' => 'Емейл',
            'password' => 'Пароль',
            'password_repetition' => 'Повтор пароля', 
            'role_id' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Problems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProblems()
    {
        return $this->hasMany(Problem::class, ['user_id' => 'id_user']);
    }
     // PKGH IdentityInterface {
        public static function findIdentity($id_user)
        {
        return static::findOne($id_user);
        }
        public static function findIdentityByAccessToken($token, $type = null)
        {
        }
        public function getId()
        {
        return $this->id_user;
        }
        public function getAuthKey()
        {
        }
        public function validateAuthKey($authKey)
        {
        }          
     // } PKGH IdentityInterface
     public static function findByUsername($username)
     {
        return static::findOne(['username'=>$username]);
     }
     public function validatePassword($password)
     {
     return $this->password === $password;
     }
}
