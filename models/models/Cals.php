<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cals".
 *
 * @property integer $id
 * @property string $caldate
 * @property string $by
 * @property string $remark
 * @property integer $user_id
 * @property string $regdate
 * @property string $updatedate
 */
class Cals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['caldate', 'regdate', 'updatedate'], 'safe'],
            [['user_id'], 'integer'],
            [['by', 'remark'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caldate' => 'วันทีสอบเทียบ',
            'by' => 'ผู้ทำการสอบเทียบ',
            'remark' => 'หมายเหตุ',
            'user_id' => 'ผู้บันทึก',
            'regdate' => 'Regdate',
            'updatedate' => 'Updatedate',
        ];
    }
    public function getCalitem(){ // เชื่อมจาก cals ไปหา calitems
        return $this->hasMany(Calitems::className(), ['cal_id'=>'id']);
    }
}
