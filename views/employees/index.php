<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายชื่อสมาชิก';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute'=>'avatar',
                'format'=>'html',
                'value'=>function($model){
                    return html::img('avatars/'.$model->avatar,['class'=>'thumbnail-responsive','style'=>'width: 80px;']);
                }
            ],
            'cid',
            [
                'label' => 'ชื่อ-สกุล',
                'attribute' => 'fname',
                'value' => function($model) {
                    return $model->pname . '' . $model->fname . ' ' . $model->lname;
                }
            ],
            [
                'attribute' => 'sex',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->sex == '1' ? "ชาย" : "หญิง";
                }
            ],
            'birthdate',
            'address',
            [
                'attribute' => 'tumbon',
                'value' => 'distict.DISTRICT_NAME',
            ],
            [
                'attribute' => 'ampur',
                'value' => 'amphur.AMPHUR_NAME',
            ],
            [
                'attribute' => 'tumbon',
                'value' => 'prov.PROVINCE_NAME',
            ],
            'education',
            'ability',
            'tel',
            'comein',  
            [
              'attribute'=>'department_id',
              'value'=>'depart.name'  
            ],        
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->status == '1' ? "<i class=\"glyphicon glyphicon-ok\"></i>" :
                            "<i class=\"glyphicon glyphicon-remove\"></i>";
                }
            ],
            [
                'attribute' => 'พิมพ์',
                'format' => 'raw',
                'value' => function($data) {
                 $path = ('index.php?r=/employees/report&id=' . $data->id);                
                 return Html::a(' <i class="glyphicon glyphicon-print"> </i>', $path, ['target' => '_blank', 'data-pjax' => 0, 'class' => 'btn btn-info btn-sm', 'title' => Yii::t('kvgrid', 'พิมพ์')]);
                 },
                       'contentOptions' => ['style' => 'width: 50px;text-align:center']
          ],            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
