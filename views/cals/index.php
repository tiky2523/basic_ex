<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\CalitemsSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ทะเบียนการสอบเทียบ-Expand Grid-DynamicForm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล', ['create'],
                        ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value'=> function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;                    
                },
                'detail'=> function($model, $key, $index, $column){
                    $searchModel = new CalitemsSearch();
                    $searchModel ->cal_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    
                    return Yii::$app->controller->renderPartial('_calitem',[
                        'searchModel'=> $searchModel,
                        'dataProvider'=> $dataProvider,
                    ]);
                 }
                ],
            'caldate',
            'by',
            'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
