
<?php
$this->params['breadcrumbs'][] = $this->title;

//use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
?>

<p align="left">
    <a class="btn btn-success tsb f22p" role="button" data-toggle="collapse" 
       href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        ชุดคำสั่ง
    </a>
</p>
<div class="collapse" id="collapseExample">
    <div class="well" align="left">
        <?= $sql ?>
    </div>
</div>
<div class="pull-left">
    <a class="btn  btn-primary"
       href="<?= Url::to(['toollists']) ?>">
        <i class="glyphicon glyphicon-chevron-left"> ย้อนกลับ</i>
    </a>
</div>
<?php

function filter($col) {
    $filterresult = Yii::$app->request->getQueryParam('filterresult', '');
    if (strlen($filterresult) > 0) {
        if (strpos($col['result'], $filterresult) !== false) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}
$filteredData = array_filter($rawData, 'filter');
$searchModel = ['result' => Yii::$app->request->getQueryParam('$filterresult', '')];

$dataProvider = new ArrayDataProvider([

    'allModels' => $filteredData,
    'pagination' => [
        'pagesize' => 15
    ],
    'sort' => [
    //'attributes' => count($rawData[0]) > 0 ? array_keys($rawData[0]) : array()
        ]]);

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'label' => 'ประเภทครุภัณฑ์ ',
        'attribute' => 'type_name',
        'headerOptions' => ['class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'รายการครุภัณฑ์ ',
        'attribute' => 'name_list',
        'headerOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'เลขครุภัณฑ์',
        'attribute' => 'tnumber',
        'headerOptions' => ['class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'แผนก',
        'attribute' => 'dep',
        'headerOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'งบซื้อ',
        'attribute' => 'budget',
        'headerOptions' => ['class' => 'text-center'],
    ],
];
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'columns' => $gridColumns,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => FALSE,
    'panel' => [
        'type' => GridView::TYPE_SUCCESS,
        'heading' => 'รายการครุภัณฑ์',
    ],
]);
?>

<?php
$script = <<< JS
$(function(){
    $("label[title='Show all data']").hide();
});
        
$('#btn_sql').on('click', function(e) {
    
   $('#sql').toggle();
});
JS;
$this->registerJs($script);
?>
<?php
// You only need add this,
$this->registerJs('
        var gridview_id = ""; 
        var columns = [2]; 

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