<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */

$this->title = 'บันทึกข้อมูล';
$this->params['breadcrumbs'][] = ['label' => 'รายชื่อสมาชิก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-create">
    <div class="panel panel-success">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-pencil"></i> 
                <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
                'amp' => [],
                'tum' => []
            ])
            ?>
        </div> 
    </div>        
</div>

