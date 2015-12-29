<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการครุภัณฑ์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-detail">

    <div class="panel panel-info">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> 
<?= Html::encode($this->title) ?></h4></div>
        <div class="panel-body">

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',            
                    [
                        'attribute' => 'pictool',
                        'format' => 'html',
                        'value' => function($model) {
                            return html::img('pictools/' . $model->pictool, ['class' => 
                                'thumbnail-responsive',
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
                        ],
                    ]);
                    ?>

        </div> 
    </div>        
</div>

