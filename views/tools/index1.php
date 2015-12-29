<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการครุภัณฑ์-GridView Export';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-index1">

    <div class="panel panel-info">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-list-alt"></i> 
               <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล', ['create'],
                ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],   
    'filterModel'=>$searchModel,    
    'responsive' => TRUE,
    'hover' => true,   
    'panel' => [
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,        
    ],
    'exportConfig' => [       
        GridView::PDF => [],
        GridView::EXCEL => []            
        ],    
    'columns' => [
        ['class'=>'kartik\grid\SerialColumn'],                      
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
                'label' => 'เลขครุภัณฑ์',
                'attribute' => 'fnumber',
                'value' => function($model) {
                    return $model->fnumber . '-' . $model->lnumber;
                }
            ],
            [
                'attribute' => 'department_id', 
                'value' => 'deptool.name',
            ], 
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

