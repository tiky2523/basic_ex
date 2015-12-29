<?php

$this->title = 'ค่าเสื่อม';
$this->params['breadcrumbs'][]=$this->title;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>

<a href="#" id="btn_sql">ชุดคำสั่ง</a>
<div id="sql" style="display: none"><?= $sql ?></div>

<?php Pjax::begin();?> 
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => FALSE,
    'panel' => [
        'heading'=>'ค่าเสื่อม',
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_SUCCESS,
       
    ],
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],
        [
        'label' => 'รายการ',
        'attribute' => 'name_list',
        'headerOptions' => ['class' => 'text-center'],      
    ],
    [
        'label' => 'เลขครุภัณฑ์',
        'attribute' => 'numberpas',
        'headerOptions' => ['class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'แผนก',
        'attribute' => 'dep',
        'headerOptions' => ['class' => 'text-center'],     
    ],
    [
        'label' => 'ปีงบที่ซื้อ',
        'attribute' => 'yearbudget',
        'headerOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'ราคาซื้อ',
        'attribute' => 'price',
        'headerOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'ค่าซาก/ปี',
        'attribute' => 'peryeaer',
        'headerOptions' => ['class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'ระยะเวลาใช้งาน',
        'attribute' => 'yearuse',
        'headerOptions' => ['class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'label' => 'ค่าเสื่อม',
        'attribute' => 'decra',
        'headerOptions' => ['class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center'],
    ],
       ],    
]);
?>

<div class="footerrow" style="padding-top: 60px">
    
</div>
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

