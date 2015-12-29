<?php
$this->title = 'การสอบเทียบเครื่องมือ';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
?>

<a href="#" id="btn_sql">ชุดคำสั่ง</a>
<div id="sql" style="display: none"><?= $sql ?></div>

<div class='well'>
    <form method="POST">
        ระหว่างวันที่:
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-5">
                <?php
                echo yii\jui\DatePicker::widget([
                    'name' => 'date1',
                    'value' => $date1,
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ],
                ]);
                ?>           
                ถึงวันที่:
                <?php
                echo yii\jui\DatePicker::widget([
                    'name' => 'date2',
                    'value' => $date2,
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ],
                ]);
                ?>
            </div> 
            <div class="col-xs-4 col-sm-4 col-md-2">
                <button class='btn btn-danger'>ประมวลผล</button>
            </div>   
        </div>
    </form>
</div>

<?php Pjax::begin(); ?> 
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'responsive' => TRUE,
    'hover' => true,
    'floatHeader' => FALSE,
    'panel' => [
        'heading' => 'รายการสอบเทียบค่ามาตรฐาน',
        'before' => '',
        'type' => \kartik\grid\GridView::TYPE_INFO,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'วันที่สอบเทียบ',
            'attribute' => 'caldate',
            'headerOptions' => ['class' => 'text-center'],
        ],
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
            'label' => 'ผลสอบเทียบ',
            'attribute' => 'result',
            'headerOptions' => ['class' => 'text-center'],
        ],
        [
            'label' => 'หมายเหตุ',
            'attribute' => 'cuase',
            'headerOptions' => ['class' => 'text-center'],
        ],
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
