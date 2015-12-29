<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Calitems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calitems-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cal_id')->textInput() ?>

    <?= $form->field($model, 'tool_id')->textInput() ?>

    <?= $form->field($model, 'result')->dropDownList([ 'ผ่าน' => 'ผ่าน', 'ไม่ผ่าน' => 'ไม่ผ่าน', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'cuase')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
