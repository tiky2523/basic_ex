<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tooltypes".
 *
 * @property integer $id
 * @property string $type_name
 */
class Tooltypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tooltypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'ประเภท',
        ];
    }
    public function getTooltooltype(){
        return $this->hasMany(Tools::className(), ['tooltype_id'=>'id']);
    }
}
