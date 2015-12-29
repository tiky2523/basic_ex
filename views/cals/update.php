<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cals */

$this->title = 'แก้ไขข้อมูล: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ทะเบียนการสอบเทียบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cals-update">

    <div class="panel panel-primary">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-edit"></i> 
                <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
         'modelsCalitems'=>$modelsCalitems
    ]) ?>

        </div> 
    </div>        
</div>

