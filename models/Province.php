<?php

namespace app\models\Province;

use Yii;

/**
 * This is the model class for table "base_province".
 *
 * @property int $id รหัสจังหวัด
 * @property string $province_name จังหวัด
 * @property string|null $province_name_en Province
 *
 * @property BaseDistrict[] $baseDistricts
 * @property BaseTambon[] $baseTambons
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'base_province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_name'], 'required'],
            [['id'], 'integer'],
            [['province_name', 'province_name_en'], 'string', 'max' => 60],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสจังหวัด',
            'province_name' => 'จังหวัด',
            'province_name_en' => 'Province',
        ];
    }

    /**
     * Gets query for [[BaseDistricts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaseDistricts()
    {
        return $this->hasMany(BaseDistrict::className(), ['base_province_id' => 'id']);
    }

    /**
     * Gets query for [[BaseTambons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaseTambons()
    {
        return $this->hasMany(BaseTambon::className(), ['base_province_id' => 'id']);
    }
}
