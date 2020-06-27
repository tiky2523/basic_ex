<?php

namespace app\models\tambon;

use Yii;

/**
 * This is the model class for table "base_tambon".
 *
 * @property int $id รหัสตำบล
 * @property int $base_district_id รหัสอำเภอ
 * @property int $base_province_id รหัสจังหวัด
 * @property string $tambon_name ตำบล
 *
 * @property BaseDistrict $baseDistrict
 * @property BaseProvince $baseProvince
 */
class Tambon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'base_tambon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'base_district_id', 'base_province_id', 'tambon_name'], 'required'],
            [['id', 'base_district_id', 'base_province_id'], 'integer'],
            [['tambon_name'], 'string', 'max' => 60],
            [['id'], 'unique'],
            [['base_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaseDistrict::className(), 'targetAttribute' => ['base_district_id' => 'id']],
            [['base_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaseProvince::className(), 'targetAttribute' => ['base_province_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสตำบล',
            'base_district_id' => 'รหัสอำเภอ',
            'base_province_id' => 'รหัสจังหวัด',
            'tambon_name' => 'ตำบล',
        ];
    }

    /**
     * Gets query for [[BaseDistrict]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaseDistrict()
    {
        return $this->hasOne(BaseDistrict::className(), ['id' => 'base_district_id']);
    }

    /**
     * Gets query for [[BaseProvince]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaseProvince()
    {
        return $this->hasOne(BaseProvince::className(), ['id' => 'base_province_id']);
    }
}
