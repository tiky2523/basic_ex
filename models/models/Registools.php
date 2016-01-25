<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registools".
 *
 * @property integer $id
 * @property string $name_list
 * @property integer $year
 * @property string $fnumber
 */
class Registools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year'], 'integer'],
            [['name_list','fnumber'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_list' => 'รายการ',            
            'year' => 'อายุการใช้งาน',
            'fnumber' => 'เลขประจำกลุ่ม',
        ];
    }
    public function getToolregis(){ // เชื่อมจาก registool ไปหา tool
        return $this->hasMany(Tools::className(), ['registool_id'=>'id']);
    }
}
