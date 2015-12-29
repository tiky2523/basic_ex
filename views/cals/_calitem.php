<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CalitemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สอบเทียบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calitems-index">

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'striped'=>FALSE,
        'hover'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'cal_id',
            [
                 'attribute'=>'tool_id',
                 'value' => function ($model) {
                    return $model->tool->registool->name_list.''.$model->tool->fnumber.
                           '-'.$model->tool->lnumber.'-'.$model->tool->deptool->name; 
                },
             ],            
            'result',
            'cuase',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
