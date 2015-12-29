<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการครุภัณฑ์-Editable GridView';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-index3">

    <div class="panel panel-info">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-list-alt"></i> 
               <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">
    <?php // $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล', ['create'],
                ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',            
            [
                'attribute'=>'pictool',
                'format'=>'html',
                'value'=>function($model){
                    return html::img('pictools/'.$model->pictool,['class'=>'thumbnail-responsive',
                        'style'=>'width: 80px;']);
                }
            ],
            [
                'attribute' => 'registool_id', 
                'value' => 'registool.name_list',
            ],
           [
                'attribute' => 'tooltype_id', 
                'value' => 'tooltypetool.type_name',
            ],
            [
                'label' => 'เลขครุภัณฑ์1',
                'attribute' => 'fnumber',
                'value' => function($model) {
                    return $model->fnumber . '-' . $model->lnumber;
                }
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'label' => 'เลขครุภัณฑ์2',
                'attribute' => 'lnumber', 
                'value' => function($model) {
                    return $model->lnumber;
                },
                'contentOptions'=>['class'=>'text-center']
            ],        
            [
                'attribute' => 'department_id', 
                'value' => 'deptool.name',
            ],        
                  
//            'buydate',
//            'okdate',
//             'yearbudget',
//             'company_id',
//             'price',
//             'budget',
//             'serial',
//             'model',
//             'wardate',             
//             'howbuy',
//             'exprie',
//             'expriedate',
//             'expriecase',                         
            // 'user_id',
            // 'regdate',
            // 'updatedate',
                    

            [
            'class' => 'yii\grid\ActionColumn',
            'options'=>['style'=>'width:140px;'],
            'buttonOptions'=>['class'=>'btn btn-default'],
            'template'=>'<div class="btn-group btn-group-sm text-center" role="group">
                            {view} {update} {delete} </div>'
         ],
                  ],
    ]); ?>

        </div> 
    </div>        
</div>

