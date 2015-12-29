<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Registools */

$this->title = 'แก้ไขรายการ: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registools-update">
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
