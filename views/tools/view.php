<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Tools */

$this->title = $model->registool->name_list;
$this->params['breadcrumbs'][] = ['label' => 'รายการครุภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-view">

    <div class="panel panel-info">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-search"></i> 
                ข้อมูล : <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

            <p>
                <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a('ลบ', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'ยืนยันการลบ?',
                        'method' => 'post',
                    ],
                ])
                ?>
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มรายการ', ['create', 
                    'id' => $model->id], ['class' => 'btn btn-success']) ?>
            </p>
            <div> <?= Html::img('pictools/' . $model->pictool, ['class' => 'thumbnail img-responsive',
                'width' => '150px;']) ?></div>
            <?=
            DetailView::widget([
                'model' => $model,
                'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
                //'striped'=>false,
                'attributes' => [
//            'id',
                    [
                        'label'=>'เลขครุภัณฑ์',
                        'attribute'=>'fnumber',
                        'value'=>$model->fnumber.'-'.$model->lnumber,
                    ],
                    [
                        'attribute' => 'registool_id',
                        'value' => $model->registool->name_list,                        
                    ], 
                    [
                        'attribute' =>  'tooltype_id',
                        'value' => $model->tooltypetool->type_name,                        
                    ], 
                   
                    'buydate',
                    'okdate',
                    'yearbudget',
                    'budget',
                    'howbuy',
                    [
                        'attribute' => 'company_id',
                        'value' => $model->comtool->company_name,                        
                    ], 
                    'price',
                    
                    'serial',
                    'model',
                    'wardate',
                    [
                        'label'=>'ใช้งานอยู่ที่แผนก',
                        'attribute' => 'department_id', 
                        'value' => $model->deptool->name,                        
                    ], 
                    
                    'expriedate',
                    'expriecase',                    
                    [
                        'attribute' => 'exprie',
                        'format' => 'html',
                        'value' => $model->exprie == '1' ? "<i class=\"glyphicon glyphicon-ok\"></i>" :
                                "<i class=\"glyphicon glyphicon-remove\"></i>",
                    ],

//            'pictool',
//            'user_id',
//            'regdate',
//            'updatedate',
                ],
            ])
            ?>

        </div> 
    </div>        
</div>
