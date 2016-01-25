<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calitems".
 *
 * @property integer $id
 * @property integer $cal_id
 * @property integer $tool_id
 * @property string $result
 * @property string $cuase
 */
class Calitems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calitems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cal_id', 'tool_id'], 'integer'],
            [['result'], 'string'],
            [['cuase'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cal_id' => 'Cal ID',
            'tool_id' => 'รายการ',
            'result' => 'ผลการสอบเทียบ',
            'cuase' => 'สาเหตุ',
        ];
    }
    public function getCal(){ // เชื่อมจาก calitems ไปหา cals
        return $this->hasOne(Cals::className(), ['id'=>'cal_id']);
    }
     public function getTool(){
    return $this->hasOne(Tools::className(), ['id' => 'tool_id']);        
    }
    
}
