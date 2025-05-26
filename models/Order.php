<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $date
 * @property int|null $status_id
 * @property int|null $user_id
 * @property string $adress
 * @property string $payment_method
 *
 * @property Cart[] $carts
 * @property OrderStatus $status
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['status_id', 'user_id'], 'integer'],
            [['adress', 'payment_method'], 'required'],
            [['payment_method'], 'string'],
            [['adress'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'status_id' => 'Status ID',
            'user_id' => 'User ID',
            'adress' => 'Adress',
            'payment_method' => 'Payment Method',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getCartItems()
    {
        return $this->hasMany(Cart::class, ['order_id' => 'id']);
    }
    public function getTotalSum()
{
    $total = 0;
    foreach ($this->carts as $cartItem) {
        if ($cartItem->product) {
            $total += $cartItem->product->price * $cartItem->count;
        }
    }
    return $total;
}
    
        public function getStatusName()
        {
            return $this->status ? $this->status->name : 'Неизвестный статус';
        }
    
        public function getUserName()
        {
            return $this->user ? $this->user->nickname : 'Неизвестный пользователь';
        }
        public function getPaymentMethodName()
        {
            return $this->payment_method ? $this->payment_method : 'Неизвестный способ оплаты';
        }
}
