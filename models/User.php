<?php

namespace app\models;

use Yii;
use \yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $nickname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $admin
 *
 * @property Cart[] $carts
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $check_password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nickname', 'username', 'password', 'email', 'phone'], 'required'],
            [['admin'], 'integer'],
            [['nickname', 'username', 'password', 'email', 'phone'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['email'], 'email'],
            [['phone'], 'match', 'pattern' => '/^\+?[0-9]{10,15}$/', 'message' => 'Телефон должен содержать только цифры и начинаться с +'],
            [['nickname'], 'match', 'pattern' => '/^[a-zA-Zа-яА-ЯёЁ0-9\s\-]+$/u', 'message' => 'ФИО может содержать только буквы, пробелы и дефисы'],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z0-9-]+$/', 'message' => 'Разрешены только латиница, цифры и тире'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/', 'message' => 'Пароль может содержать только латинские буквы и цифры'],    ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'ФИО',
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Почта',
            'phone' => 'Телефон',
            'admin' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['user_id' => 'id']);
    }
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }
public static function findIdentity($id)
{
    return static::findOne($id);
}

public static function findIdentityByAccessToken($token, $type = null)
{

}

public function getId()
{
    return $this->id;
}

public function getAuthKey()
{

}

public function validateAuthKey($authKey)
{

}

public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

public function validatePassword($password)
{
    return $this->password === $password;
}

public function isAdmin()
{
    return boolval($this->admin);
}

}