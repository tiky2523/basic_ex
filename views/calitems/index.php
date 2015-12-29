<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CalitemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calitems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calitems-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Calitems', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cal_id',
            'tool_id',
            'result',
            'cuase',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
