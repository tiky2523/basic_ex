<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tooltypes */

$this->title = 'บันทึกประเภทครุภัณฑ์';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทครุภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tooltypes-create">

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
