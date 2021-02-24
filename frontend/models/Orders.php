<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "orders".
 *
 * @property int $orderId
 * @property int $userId
 * @property int $total
 * @property string $orderStatus
 * @property int $deliveryId
 * @property string $createdAt
 * @property int $createdBy
 *
 * @property Orderitems[] $orderitems
 * @property User $user
 * @property Delivery $delivery
 * @property Payments[] $payments
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'total', 'orderStatus', 'deliveryId', 'createdBy'], 'required'],
            [['userId', 'total', 'deliveryId', 'createdBy'], 'integer'],
            [['orderStatus'], 'string'],
            [['createdAt'], 'safe'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['deliveryId'], 'exist', 'skipOnError' => true, 'targetClass' => Delivery::className(), 'targetAttribute' => ['deliveryId' => 'deliveryId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orderId' => 'Order ID',
            'userId' => 'User ID',
            'total' => 'Total',
            'orderStatus' => 'Order Status',
            'deliveryId' => 'Delivery ID',
            'createdAt' => 'Created At',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Orderitems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderitems()
    {
        return $this->hasMany(Orderitems::className(), ['orderId' => 'orderId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * Gets query for [[Delivery]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery()
    {
        return $this->hasOne(Delivery::className(), ['deliveryId' => 'deliveryId']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['orderId' => 'orderId']);
    }
}
