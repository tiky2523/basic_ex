<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Registools;
use app\models\Tooltypes;
use app\models\Companys;
use app\models\Departments;
use kartik\select2\Select2;
use yii\jui\DatePicker;
use yii\helpers\Url;
use kartik\checkbox\CheckboxX;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Tools */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tools-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">        
        <div class="col-xs-6 col-sm-6 col-md-6">            
            <?=
            $form->field($model, 'registool_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Registools::find()->all(), 'id', 'name_list'),
                'language' => 'th',
                'options' => ['placeholder' => 'เลือกรายการ ...', 'id' => 'toolType'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?= $form->field($model, 'fnumber')->textInput(['readonly' => true, 'maxlength' => true]) ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?=
            $form->field($model, 'lnumber')->widget(\yii\widgets\MaskedInput::classname(), [
                'mask' => '9999',
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">             
            <?=
            $form->field($model, 'tooltype_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Tooltypes::find()->all(), 'id', 'type_name'),
                'language' => 'th',
                'options' => ['placeholder' => 'เลือกประเภท ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>	
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <?=
            $form->field($model, 'buydate')->widget(DatePicker::className(), [
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
        <div class="col-xs-2 col-sm-2 col-md-2">
            <?=
            $form->field($model, 'okdate')->widget(DatePicker::className(), [
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

        <div class="col-xs-2 col-sm-2 col-md-2">
<?= $form->field($model, 'yearbudget')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">    
        <div class="col-xs-6 col-sm-6 col-md-6">            
            <?=
                    $form->field($model, 'budget')
                    ->radioList(app\models\Tools::itemAlias('budget'))
            ?>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">            
            <?=
                    $form->field($model, 'howbuy')
                    ->radioList(app\models\Tools::itemAlias('howbuy'))
            ?>
        </div>
    </div>
    <div class="row">        
        <div class="col-xs-6 col-sm-6 col-md-6">           
            <?=
            $form->field($model, 'company_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Companys::find()->all(), 'id', 'company_name'),
                'language' => 'th',
                'options' => ['placeholder' => 'เลือกบริษัท ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>    
    <div class="row">

        <div class="col-xs-3 col-sm-3 col-md-3">
            <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?=
            $form->field($model, 'wardate')->widget(DatePicker::className(), [
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
    </div>
    <div class="well">
        <div class="row">    
            <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'pictool_img')->fileInput() ?>
            </div>

<?php if ($model->pictool) { ?>
    <?= Html::img('pictools/' . $model->pictool, ['class' => 'img-responsive', 'width' => '150px;']); ?>
<?php } ?> 
        </div> 
    </div> 
    <hr>
    <p align="right">
        <a class="btn btn-warning tsb f22p" role="button" data-toggle="collapse" 
           href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="glyphicon glyphicon-pencil"></i> แทงจำหน่าย
        </a>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="well" align="left">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">            
                    <?= $form->field($model, 'exprie')->widget(CheckboxX::classname(), [
                        'pluginOptions' => ['threeState' => false]]);
                    ?>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">           
                    <?=
                    $form->field($model, 'expriedate')->widget(DatePicker::className(), [
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
                <div class="col-xs-6 col-sm-6 col-md-6">            
<?=
        $form->field($model, 'expriecase')
        ->checkboxList(app\models\Tools::itemAlias('expriecase'))
?>
                </div>
            </div>
        </div>
    </div>    


    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
?>
    </div>

<?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
        $('#toolType').change(function(){
            var tooltypeID = $(this).val();
           
            $.get('index.php?r=registools/get-tooltype-numbergroup',
                { tooltypeID : tooltypeID }, function(data){
        
                    var data = $.parseJSON(data);                       
                    
                    $('#tools-fnumber').attr('value',data.fnumber);
                });
        });
JS;
$this->registerJs($script);
?>