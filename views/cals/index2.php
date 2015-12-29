<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\CalitemsSearch;
//use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ทะเบียนการสอบเทียบ-Filter DatepickerRange on GridView';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cals-index2">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล',
                ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column) {
                    $searchModel = new CalitemsSearch();
                    $searchModel->cal_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request
                                    ->queryParams);

                    return Yii::$app->controller->renderPartial('_calitem', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                    ]);
                }
                    ],
                    [
                        'attribute' => 'caldate',
                        'width'=>'280px',
                        'value' => 'caldate', 
                        'format'=>['date', 'php:Y-m-d'],          
                        'headerOptions' => ["style"=>"width:300px;"], 
                        'filter' => DateRangePicker::widget([
                            'model' => $searchModel,
                            'attribute'=>'caldate', 
                            'useWithAddon'=>true,
                            'convertFormat'=>true,                
                            'language'=>'th',            
                            'hideInput'=> 1,                                
                            'pluginOptions'=>[
                                'locale'=>[                                    
                                    'format'=>'Y-m-d',
                                    'separator'=>'&'],
                                'opens'=>'right',                                
                            ]
                        ]),
                ],
                    'by',
                    'remark',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

</div>
<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
});
JS;
$this->registerJs($script);
?>