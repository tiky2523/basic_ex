<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Tools;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Cals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cals-form">

   <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <div class="row">        
	<div class="col-xs-2 col-sm-2 col-md-2">           
             <?=
            $form->field($model, 'caldate')->widget(DatePicker::className(), [
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
	<div class="col-xs-5 col-sm-5 col-md-5">
             <?= $form->field($model, 'by')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-xs-5 col-sm-5 col-md-5">
            <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>
	</div>	
</div>
    
<div class="row">
        <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus"></i> บันทึกผล</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', 
                'widgetBody' => '.container-items', 
                'widgetItem' => '.item', 
                'limit' => 10, 
                'min' => 1, 
                'insertButton' => '.add-item', 
                'deleteButton' => '.remove-item', 
                'model' => $modelsCalitems[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'tool_id',
                    'result',
                    'cuase',      
                ],
            ]); ?>
            <div class="container-items">
            <?php foreach ($modelsCalitems as $i => $modelCalitems): ?>
                <div class="item panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title pull-left"><i class="glyphicon glyphicon-search"></i> 
                            คลิกเลือกรายการ</h4>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs">
                                <i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs">
                                <i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php                            
                            if (! $modelCalitems->isNewRecord) {
                                echo Html::activeHiddenInput($modelCalitems, "[{$i}]id");
                            }
                        ?>                        
                        <div class="row">
                            <div class="col-sm-7">                                
                                <?=$form->field($modelCalitems, "[{$i}]tool_id")->label('รายการเครื่องมือ')
                                    ->dropDownList(
                                           ArrayHelper::map(Tools::find()->where(['tooltype_id'=>'4'])->all(), 'id', 
                                                   function($model, $defaultValue) {
                                                return $model->registool->name_list.':'.$model->fnumber.'-'.$model->lnumber.
                                                        ':'.$model->deptool->name;
                                            }),[
                                                'prompt'=>'เลือกเครื่องมือ...'
                                            ]
                                           )
                               ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelCalitems, "[{$i}]result")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelCalitems, "[{$i}]cuase")->textInput(['maxlength' => true]) ?>
                            </div>
                       </div>                     
                        </div>                       
                    </div>
                </div>
            <?php endforeach; ?>
<!--            </div>-->
            <?php DynamicFormWidget::end(); ?>
        </div>
       </div> 
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', 
    ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
