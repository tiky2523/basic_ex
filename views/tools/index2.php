<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการครุภัณฑ์-Modal on GridView';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">รายละเอียด</h4>',
    'size' => 'modal-lg',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
]);
Modal::end();
?>

<div class="tools-index2">

    <div class="panel panel-info">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-list-alt"></i> 
                <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

            <p>
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล'
                        , ['create'], ['class' => 'btn btn-success'])
                ?>
            </p>
            <?php Pjax::begin(['id' => 'tools-grid']); ?>
            <?php
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
                'filterModel' => $searchModel,
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
                    ['class' => 'kartik\grid\SerialColumn'],
                    [
                        'attribute' => 'pictool',
                        'format' => 'html',
                        'value' => function($model) {
                            return html::img('pictools/' . $model->pictool,
                                    ['class' => 'thumbnail-responsive',
                                        'style' => 'width: 80px;']);
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
                                'template' => ' {view}{update}{delete}',
                                'contentOptions' => [
                                    'noWrap' => true
                             ],
                                'buttons' => [
                                    'view' => function ($url, $model, $key) {
                                        return Html::a('<span class="glyphicon glyphicon-search"></span>',
                                                            '#', [
                                                    'class' => 'activity-view-link',
                                                    'title' => 'ดูข้อมูล',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#activity-modal',
                                                    'data-id' => $key,
                                                    'data-pjax' => '0',
                                        ]);
                                    },
                                            'update' => function($url, $model, $key) {
                                        return Html::a('<i class="glyphicon glyphicon-edit"></i>',
                                                            '#', [
                                                    'class' => 'activity-update-link',
                                                    'title' => 'แก้ไข',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#activity-modal',
                                                    'data-id' => $key,
                                                    'data-pjax' => '0',
                                        ]);
                                    },
                                        ]
                                    ],
                                ],
                            ]);
                            ?>
                <?php Pjax::end() ?>
                        </div> 
                    </div>        
                </div>

                <?php $this->registerJs('
        function init_click_handlers(){            
            $(".activity-view-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "?r=tools/view",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);                            
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "?r=tools/update",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);                            
                            $("#activity-modal").modal("show");
                        }
                    );
                });            
        }
        init_click_handlers(); //first run
        $("#tools-grid").on("pjax:success", function() {
          init_click_handlers(); //reactivate links in grid after pjax update
        });'); ?>