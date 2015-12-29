<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Provinces;
use kartik\widgets\DepDrop;
use app\models\Amphures;
use app\models\Districts;
use yii\helpers\Url;
use app\models\Departments;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="employees-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row"> 
        <div class="col-xs-2 col-sm-2 col-md-2">           
            <?php
            echo $form->field($model, 'pname')->dropDownList([
                'นาย' => 'นาย',
                'นาง' => 'นาง',
                'นางสาว' => 'นางสาว',
                    ], ['prompt' => 'เลือกคำนำหน้า..']);
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">            
            <?php
            echo $form->field($model, 'sex')->radioList([
                '1' => 'ชาย',
                '2' => 'หญิง',
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3">           
            <?=
            $form->field($model, 'birthdate')->widget(DatePicker::className(), [
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => ['class' => 'form-control'
                ],
            ]);
            ?>
        </div>    
        <div class="col-xs-3 col-sm-3 col-md-3"> 
            <?=
            $form->field($model, 'cid')->widget(\yii\widgets\MaskedInput::classname(), [
                'mask' => '9-9999-99999-99-9',
            ])
            ?>
        </div>        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?= $form->field($model, 'address')->textarea(['row' => 3]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3">           
            <?=
            $form->field($model, 'chw')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(app\models\Provinces::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME'),
                'language' => 'th',
                'options' => ['placeholder' => 'เลือกจังหวัด ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>  
        <div class="col-xs-3 col-sm-3 col-md-3">           
            <?=
            $form->field($model, 'ampur')->widget(DepDrop::className(), [
                'data' => $amp,
                'options' => ['placeholder' => '<--คลิกเลือกอำเภอ-->'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['employees-chw'],
                    'url' => yii\helpers\Url::to(['/employees/get-amp']),
                    'loadingText' => 'กำลังค้นข้อมูล...',
                ],
            ]);
            ?>
        </div>     
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?=
            $form->field($model, 'tumbon')->widget(DepDrop::className(), [
                'data' => $tum,
                'options' => ['placeholder' => '<--คลิกเลือกตำบล-->'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['employees-chw', 'employees-ampur'],
                    'url' => yii\helpers\Url::to(['/employees/get-dist']),
                    'loadingText' => 'กำลังค้นข้อมูล...',
                ],
            ]);
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?=
            $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::classname(), [
                'mask' => '999-999-9999',
            ])
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">            
            <?=
            $form->field($model, 'comein')->widget(DatePicker::className(), [
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => ['class' => 'form-control'
                ],
            ]);
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">            
            <?=
            $form->field($model, 'department_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Departments::find()->all(), 'id', 'name'),
                'language' => 'th',
                'options' => ['placeholder' => 'เลือกแผนก ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?= $form->field($model, 'education')->dropDownList([ 'ปริญญาตรี' => 'ปริญญาตรี', 'ปริญญาโท' => 'ปริญญาโท', 'สูงกว่าปริญญาโท' => 'สูงกว่าปริญญาโท', 'ปวส/อนุปริญญา' => 'ปวส/อนุปริญญา', 'มัธยมศึกษา6' => 'มัธยมศึกษา6', 'มัธยมศึกษา3' => 'มัธยมศึกษา3', 'ประถมศึกษา' => 'ประถมศึกษา',], ['prompt' => '']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6col-md-6">
            <?=
                    $form->field($model, 'ability')
                    ->checkboxList(app\models\Employees::itemAlias('ability'))
            ?>
        </div>
    </div>
    <div class="row">        
        <div class="col-xs-12 col-sm-12 col-md-12  ">
            <?= $form->field($model, 'avatar_img')->fileInput() ?>       
        </div>    
    </div>     
    <?php if ($model->avatar) { ?>
        <?= Html::img('avatars/' . $model->avatar, ['class' => 'img-responsive', 'width' => '150px;']); ?>
    <?php } ?> 
              
        <?=
        $form->field($model, 'status')->widget(CheckboxX::classname(), [
            'pluginOptions' => ['threeState' => false],
        ])->label('ทำงานอยู่');
        ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
