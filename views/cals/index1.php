<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\CalitemsSearch;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ทะเบียนการสอบเทียบ-Filter Datepicker on GridView';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cals-index1">

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
                        'value' => 'caldate',
                        'format' => 'raw',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'caldate',
                            'options' => ['placeholder' => 'ระบุวันที่ ...'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true
                            ]
                        ]),
                        'headerOptions' => ['class' => 'text-left',
                                            'style' => 'width: 250px;'],
                    ],
                    'by',
                    'remark',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

</div>
