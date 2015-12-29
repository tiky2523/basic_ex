<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cals */

$this->title = 'บันทึกผลสอบเทียบ';
$this->params['breadcrumbs'][] = ['label' => 'การสอบเทียบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cals-create">

       <div class="panel panel-success">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-pencil"></i> 
                <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsCalitems'=>$modelsCalitems
    ]) ?>

        </div> 
    </div>        
</div>
