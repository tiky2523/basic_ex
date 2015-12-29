<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TooltypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประเภทครุภัณฑ์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tooltypes-index">

    <div class="panel panel-success">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-list"></i> 
                <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มรายการ', 
    ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'type_name',
            [
            'header' => 'จำนวนรายการครุภัณฑ์',  
            'format'=>'raw',
            'value' => function ($data){
                $count = \app\models\Tools::find()
                    ->where([
                        'tooltype_id'=>$data->id,
                    ])
                    ->count();
 
                if(!empty($count)){
                    return  Html::a('รวม  '.$count,['tools/detail','tooltype_id'=>$data->type_name],[
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"รายการ",
                                                    ]);
                }
                else{
                    return "-";
                }
            }
        ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
</div>

<?php
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">...</h4>',
    'size'=>'modal-lg'
]);
Modal::end();
?>
<?php
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
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