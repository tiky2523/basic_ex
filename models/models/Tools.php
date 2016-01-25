<?php

namespace app\models;
use Yii;

/**
 * This is the model class for table "tools".
 *
 * @property integer $id
 * @property integer $registool_id
 * @property integer $tooltype_id
 * @property string $buydate
 * @property string $okdate
 * @property string $yearbudget
 * @property integer $company_id
 * @property string $price
 * @property string $budget
 * @property string $serial
 * @property string $model
 * @property string $wardate
 * @property integer $department_id
 * @property string $howbuy
 * @property string $exprie
 * @property string $expriedate
 * @property string $expriecase
 * @property string $fnumber
 * @property string $lnumber
 * @property string $pictool
 * @property integer $user_id
 * @property string $regdate
 * @property string $updatedate
 */
class Tools extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    
    public $pictool_img;

    public static function tableName() {
        return 'tools';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['registool_id', 'tooltype_id', 'company_id', 'department_id', 'user_id'], 'integer'],
            [['buydate', 'okdate', 'wardate', 'expriedate', 'regdate', 'updatedate', 
                'expriecase'], 'safe'],
            [['price'], 'number'],
            [['yearbudget'], 'string', 'max' => 4],
            [['budget', 'serial', 'model', 'howbuy', 'exprie'], 'string', 'max' => 100],
            [['fnumber', 'lnumber', 'pictool'], 'string', 'max' => 255],
            //[['exprie'], 'default'=>0],
            [['pictool_img'], 'file', 'skipOnEmpty' => 'true', 'on' => 'update', 
                'extensions' => 'jpg,png']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'registool_id' => 'รายการครุภัณฑ์',
            'tooltype_id' => 'ประเภท',
            'buydate' => 'วันที่ซื้อ',
            'okdate' => 'วันที่ตรวจรับ',
            'yearbudget' => 'ปีงบประมาณ',
            'company_id' => 'บริษัท',
            'price' => 'ราคา/หน่วย',
            'budget' => 'ประเภทงบ',
            'serial' => 'เลขซีเรียล',
            'model' => 'ยี่ห้อ/รุ่น',
            'wardate' => 'วันที่รับประกัน',
            'department_id' => 'แผนก',
            'howbuy' => 'วิธีการจัดซื้อ',
            'exprie' => 'แทงจำหน่าย',
            'expriedate' => 'วันที่แทงจำหน่าย',
            'expriecase' => 'สาเหตุแทงจำหน่าย',
            'fnumber' => 'เลขครุภํณฑ์กลุ่ม',
            'lnumber' => 'เลขครุภํณฑ์รายการ',
            'pictool' => 'รูปภาพ',
            'pictool_img' => 'รูปภาพ',
            'user_id' => 'ผู้บันทึก',
            'regdate' => 'Regdate',
            'updatedate' => 'Updatedate',
        ];
    }

    public function getArray($value) {
        return explode(',', $value);
    }

    public function setToArray($value) {
        return is_array($value) ? implode(',', $value) : NULL;
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (!empty($this->registool_id)) {
                $this->expriecase = $this->setToArray($this->expriecase);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'budget' => array(
                'บำรงุ' => 'งบเงินบำรงุ',
                'ค่าเสื่อม' => 'งบค่าเสื่อม',
                'งบประมาณ' => 'งบประมาณ',
                'อื่นๆ' => 'อื่นๆ',
            ),
            'howbuy' => array(
                'ตกลง' => 'ตกลงราคา',
                'ประกวด' => 'ประกวดราคา',
                'สอบราคา' => 'สอบราคา',
                'Ecou' => 'E-coutions',
                'อื่นๆ' => 'อื่นๆ',
            ),
            'expriecase' => array(
                'เสื่อมสภาพ' => 'เสื่อมสภาพ',
                'ชำรุด' => 'ชำรุด',
                'เลิกใช้งาน' => 'เลิกใช้งาน',
                'ซ่อมไม่ได้' => 'ซ่อมไม่ได้',
                'อื่นๆ' => 'อื่นๆ',
            ),
        );

        if (isset($code)) {
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        } else {
            return isset($_items[$type]) ? $_items[$type] : false;
        }
    }

    public function getRegistool(){ // ความสัมพันธ์จาก tools ไปหา registools
        return $this->hasOne(Registools::className(), ['id'=>'registool_id']);
    }
    public function getDeptool(){ // ความสัมพันธ์จาก tools ไปหา departments
        return $this->hasOne(Departments::className(), ['id'=>'department_id']);
    }
    public function getComtool(){ // ความสัมพันธ์จาก tools ไปหา companys
        return $this->hasOne(Companys::className(), ['id'=>'company_id']);
    }
    public function getCalitemtool(){ // ความสัมพันธ์จาก tools ไปหา calitems
        return $this->hasMany(Calitems::className(), ['tool_id'=>'id']);
    }
    public function getTooltypetool(){ // ความสัมพันธ์จาก tools ไปหา tooltypes
        return $this->hasOne(Tooltypes::className(), ['id'=>'tooltype_id']);
    }   
    
}
