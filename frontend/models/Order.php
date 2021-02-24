<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $order_id
 * @property int $user_id
 * @property string $delivery_address
 * @property string $paymethod
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
            [['user_id', 'delivery_address'], 'required'],
            [['user_id'], 'integer'],
            [['paymethod'], 'string'],
            [['delivery_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'user_id' => 'User ID',
            'delivery_address' => 'Delivery Address',
            'paymethod' => 'Paymethod',
        ];
    }
}
