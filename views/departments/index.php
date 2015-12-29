<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Departments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'group_id',            
            'rate1',            
            ['attribute' => 'rate1',
                'format' => 'raw',
                'value' => function ($model) { 
                return StarRating::widget([
                    'model' => $model,
                    'name' => 'rating',
                    'pluginOptions'=>['showCaption'=>false,
                        'showClear'=>false,
                        'readonly'=>true],
                    'value' => $model->rate1,]);
            }],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
