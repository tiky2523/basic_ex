<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="departments-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'group_id')->widget(Select2::classname(),[
        'data'=> ArrayHelper::map(app\models\Groups::find()->all(),'id','name'),
        'language' => 'th',
        'options' => ['placeholder' => 'เลือกกลุ่มงาน ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    
    <?= $form->field($model,'rate1')->widget(StarRating::className(),[
        'pluginOptions'=>['size'=>'md',
            'showCaption'=>FALSE,]
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 
            $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

