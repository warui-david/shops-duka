<?php

namespace frontend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $paymentId
 * @property int $orderId
 * @property int $amount
 * @property int $phoneCode
 * @property int $phoneNumber
 * @property int $userId
 * @property string $status
 * @property string $createdAt
 * @property int $createdBy
 * @property string|null $MerchantRequestID
 *
 * @property Orders $order
 * @property User $user
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderId', 'amount', 'phoneCode', 'phoneNumber', 'userId', 'status', 'createdBy'], 'required'],
            [['orderId', 'amount', 'phoneCode', 'phoneNumber', 'userId', 'createdBy'], 'integer'],
            [['status'], 'string'],
            [['createdAt'], 'safe'],
            [['MerchantRequestID'], 'string', 'max' => 100],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['orderId' => 'orderId']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'paymentId' => 'Payment ID',
            'orderId' => 'Order ID',
            'amount' => 'Amount',
            'phoneCode' => 'Phone Code',
            'phoneNumber' => 'Phone Number',
            'userId' => 'User ID',
            'status' => 'Status',
            'createdAt' => 'Created At',
            'createdBy' => 'Created By',
            'MerchantRequestID' => 'Merchant Request ID',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['orderId' => 'orderId']);
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
}
