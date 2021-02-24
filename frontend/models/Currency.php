<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $currencyId
 * @property string|null $currencyName
 * @property string|null $currencyCode
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currencyId'], 'required'],
            [['currencyId'], 'integer'],
            [['currencyName'], 'string', 'max' => 64],
            [['currencyCode'], 'string', 'max' => 3],
            [['currencyId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'currencyId' => 'Currency ID',
            'currencyName' => 'Currency Name',
            'currencyCode' => 'Currency Code',
        ];
    }
}
