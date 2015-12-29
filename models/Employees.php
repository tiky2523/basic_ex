<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property integer $id
 * @property string $cid
 * @property string $pname
 * @property string $fname
 * @property string $lname
 * @property integer $sex
 * @property string $birthdate
 * @property string $address
 * @property integer $tumbon
 * @property integer $ampur
 * @property integer $chw
 * @property string $education
 * @property string $ability
 * @property string $tel
 * @property integer $department_id
 * @property string $comein
 * @property string $avatar
 * @property integer $status
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $avatar_img;    
    public static function tableName()
    {
        return 'employees';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'tumbon', 'ampur', 'chw', 'department_id', 'status'], 'integer'],
            [['birthdate', 'comein', 'ability'], 'safe'],
            [['education'], 'string'],
            [['cid', 'address', 'avatar'], 'string', 'max' => 255],
            [['pname', 'fname', 'lname'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 50],
            [['status'],'default','value'=>0],
            [['avatar_img'],'file','skipOnEmpty'=>'true','on'=>'update','extensions'=>'jpg,png']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'เลขที่บัตรประชาชน',
            'pname' => 'คำนำหน้า',
            'fname' => 'ชื่อ',
            'lname' => 'สกุล',
            'sex' => 'เพศ',
            'birthdate' => 'วันเกิด',
            'address' => 'ที่อยู่',
            'tumbon' => 'ตำบล',
            'ampur' => 'อำเภอ',
            'chw' => 'จังหวัด',
            'education' => 'ระดับการศึกษา',
            'ability' => 'ความสามารถพิเศษ',
            'tel' => 'โทรศัพท์',
            'department_id' => 'แผนก',
            'comein' => 'วันที่เข้าทำงาน',
            'avatar' => 'รูปประจำตัว',
            'status' => 'สถานะ',
            'avatar_img'=>'รูปภาพประจำตัว'
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
            if (!empty($this->fname)) {
                $this->ability = $this->setToArray($this->ability);                         
            }
            return true;
        } else {
            return false;
        }                
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'ability' => array(
                'กีฬา' => 'กีฬา',
                'ดนตรี' => 'ดนตรี',
                'คอมพิวเตอร์'=>'คอมพิวเตอร์',
                'ด้านอาหาร'=>'ด้านอาหาร',
                'งานฝีมือ'=>'งานฝีมือ'
                ),
            );

        if (isset($code)) {
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        } else {
            return isset($_items[$type]) ? $_items[$type] : false;
        }
    }
    public function getDistict(){
        return $this->hasOne(Districts::className(), ['DISTRICT_ID'=>'tumbon']);
    }
    public function getAmphur(){
        return $this->hasOne(Amphures::className(), ['AMPHUR_ID'=>'ampur']);
    }
    public function getProv(){
        return $this->hasOne(Provinces::className(), ['PROVINCE_ID'=>'chw']);
    }
    public function getDepart(){
        return $this->hasOne(Departments::className(), ['id'=>'department_id']);
    }
}
