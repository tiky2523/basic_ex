<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Companys */

$this->title = 'แก้ไขข้อมูล : ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'รายชื่อบริษัท', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="companys-update">

    <div class="registools-create">
<div class="panel panel-primary">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-edit"></i> 
                <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        </div> 
    </div>        
</div>
