
<?php
$this->title = 'ครุภัณฑ์-Hichart Filter with Value';

use kartik\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->params['breadcrumbs'][] = $this->title;
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

<?php Pjax::begin(); ?> 
<?php
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'label' => 'ประเภทรายการ',
        'attribute' => 'type_name',
        'format' => 'raw',
        'value' => function($model)use($type_name) {
            return Html::a(Html::encode($model['type_name']), [
                        'tools/indivtoollists/',
                        'type_name' => $model['type_name'],
            ]);
        }
            ],
            [
            'label' => 'ประเภทรายการ( modal )',
            'attribute' => 'type_name',
            'format' => 'raw',
            'value' => function ($model, $index, $widget) {
                return Html::a(
                            $model['type_name'], ['tools/indivtoollists', 'type_name' => $model['type_name'],
                                ], [
                            'data-toggle' => "modal",
                            'data-target' => "#myModalin",
                                // 'data-title'=>"แก้ไขข้อมูล",  
                                ], [
                            //'title'=>'แก้ไขข้อมูล!',
                            'target' => '_blank'
                                ]
                );
            },                   
                ],        
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'total',
                'label' => 'จำนวน',
                'format' => 'integer',
                'pageSummary' => true,
                'vAlign' => 'middle',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
        ];
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'columns' => $gridColumns,
            'responsive' => true,
            'hover' => true,
            'striped' => false,
            'floatHeader' => FALSE,
            'showPageSummary' => true,
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading' => 'ประเภทรายการครุภัณฑ์'
            ],
        ]);
        ?>
        <?php Pjax::end(); ?> 

        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'ประเภทรายการครุภัณฑ์'],
                'xAxis' => [
                    'categories' => $type_name
                ],
                'yAxis' => [
                    'title' => ['text' => 'จำนวน']
                ],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'ประเภท',
                        'data' => $total,
                        'dataLabels' => [
                            'enabled' => true,
                        ]
                    ],
                ]
            ]
        ]);
        ?>
        <?php
        Modal::begin([
            'id' => 'myModalin',
            'header' => '<h4 class="modal-title"></h4>',
            'size' => 'modal-lg',]);
        Modal::end();?>
        <?php
            $this->registerJs("
                    $('#myModalin').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget)
                    var modal = $(this)
                    var title = button.data('title') 
                    var href = button.attr('href') 
                    modal.find('.modal-title').html(title)
                    modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
                    $.post(href)
                        .done(function( data ) {
                            modal.find('.modal-body').html(data)
                        });
                    })
            ");
        ?>