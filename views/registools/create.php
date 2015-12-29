<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Registools */

$this->title = 'บันทึกชื่อรายการ';
$this->params['breadcrumbs'][] = ['label' => 'Registools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registools-create">
<div class="panel panel-success">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-pencil"></i> 
                <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        </div> 
    </div>        
</div>
