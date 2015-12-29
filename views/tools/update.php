<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tools */

$this->title = 'แก้ไขข้อมูล: ' . ' ' . $model->registool->name_list;
$this->params['breadcrumbs'][] = ['label' => 'รายการครุภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tools-update">

    
   <div class="panel panel-primary">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-edit"></i> 
                ข้อมูล : <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        </div> 
    </div>        
</div>
