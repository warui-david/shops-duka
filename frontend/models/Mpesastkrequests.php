<?php

namespace frontend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "mpesastkrequests".
 *
 * @property string $MerchantRequestID
 * @property string $phone
 * @property float $amount
 * @property string $reference
 * @property int $orderId
 * @property int $depositTransId
 * @property string $description
 * @property string $status
 * @property int $complete
 * @property string $CheckoutRequestID
 * @property int|null $userId
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Mpesac2bcallbacks $mpesac2bcallbacks
 * @property User $user
 * @property Order $order
 */
class Mpesastkrequests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mpesastkrequests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MerchantRequestID', 'phone', 'amount', 'reference', 'orderId', 'depositTransId', 'description', 'CheckoutRequestID'], 'required'],
            [['amount'], 'number'],
            [['orderId', 'depositTransId', 'complete', 'userId'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['MerchantRequestID', 'phone', 'reference', 'description', 'status', 'CheckoutRequestID'], 'string', 'max' => 191],
            [['MerchantRequestID'], 'unique'],
            [['CheckoutRequestID'], 'unique'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['orderId' => 'order_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MerchantRequestID' => 'Merchant Request ID',
            'phone' => 'Phone',
            'amount' => 'Amount',
            'reference' => 'Reference',
            'orderId' => 'Order ID',
            'depositTransId' => 'Deposit Trans ID',
            'description' => 'Description',
            'status' => 'Status',
            'complete' => 'Complete',
            'CheckoutRequestID' => 'Checkout Request ID',
            'userId' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Mpesac2bcallbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMpesac2bcallbacks()
    {
        return $this->hasOne(Mpesac2bcallbacks::className(), ['MerchantRequestID' => 'MerchantRequestID']);
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
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'orderId']);
    }
}
