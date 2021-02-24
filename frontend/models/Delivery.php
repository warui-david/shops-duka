<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property int $deliveryId
 * @property string $deliveryDesc
 * @property int $cost
 *
 * @property Orders[] $orders
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deliveryDesc', 'cost'], 'required'],
            [['cost'], 'integer'],
            [['deliveryDesc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'deliveryId' => 'Delivery ID',
            'deliveryDesc' => 'Delivery Desc',
            'cost' => 'Cost',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['deliveryId' => 'deliveryId']);
    }
}
