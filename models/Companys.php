<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companys".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $address
 */
class Companys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'บริษัท',
            'address' => 'ที่อยู่',
        ];
    }
}
