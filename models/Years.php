<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "years".
 *
 * @property integer $id
 * @property string $year
 */
class Years extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'years';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'ปี',
        ];
    }
}
