<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provinces".
 *
 * @property integer $PROVINCE_ID
 * @property string $PROVINCE_CODE
 * @property string $PROVINCE_NAME
 * @property string $PROVINCE_NAME_ENG
 */
class Provinces extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provinces';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROVINCE_CODE', 'PROVINCE_NAME', 'PROVINCE_NAME_ENG'], 'required'],
            [['PROVINCE_CODE'], 'string', 'max' => 2],
            [['PROVINCE_NAME', 'PROVINCE_NAME_ENG'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROVINCE_ID' => 'Province  ID',
            'PROVINCE_CODE' => 'Province  Code',
            'PROVINCE_NAME' => 'Province  Name',
            'PROVINCE_NAME_ENG' => 'Province  Name  Eng',
        ];
    }
    
    public function getDistp(){//relation จังหวัดไปตำบล
        return $this->hasMany(Districts::className(), ['PROVINCE_ID'=>'PROVINCE_ID']);
    }
    public function getAmpp(){//relation จังหวัดไปอำเภอ
        return $this->hasMany(Amphures::className(), ['PROVINCE_ID'=>'PROVINCE_ID']);
    }
}
