<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $countryId
 * @property string $countryName
 * @property string $couPhoneCode
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['countryName', 'couPhoneCode'], 'required'],
            [['countryName'], 'string', 'max' => 255],
            [['couPhoneCode'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'countryId' => 'Country ID',
            'countryName' => 'Country Name',
            'couPhoneCode' => 'Cou Phone Code',
        ];
    }
}
