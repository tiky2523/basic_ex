<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการครุภัณฑ์-Grouping-Sigle Column';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-index">

    <div class="panel panel-info">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-list-alt"></i> 
               <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">
    <?php // $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล', ['create'],
                ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                            {update} {delete} </div>'
         ],
                  ],
    ]); ?>

        </div> 
    </div>        
</div>

<?php
    // You only need add this,
    $this->registerJs('
        var gridview_id = ""; 
        var columns = [4]; 

        var column_data = [];
            column_start = [];
            rowspan = [];
 
        for (var i = 0; i < columns.length; i++) {
            column = columns[i];
            column_data[column] = "";
            column_start[column] = null;
            rowspan[column] = 1;
        }
 
        var row = 1;
        $(gridview_id+" table > tbody  > tr").each(function() {
            var col = 1;
            $(this).find("td").each(function(){
                for (var i = 0; i < columns.length; i++) {
                    if(col==columns[i]){
                        if(column_data[columns[i]] == $(this).html()){
                            $(this).remove();
                            rowspan[columns[i]]++;
                            $(column_start[columns[i]]).attr("rowspan",rowspan[columns[i]]);
                        }
                        else{
                            column_data[columns[i]] = $(this).html();
                            rowspan[columns[i]] = 1;
                            column_start[columns[i]] = $(this);
                        }
                    }
                }
                col++;
            })
            row++;
        });
    ');
    ?>