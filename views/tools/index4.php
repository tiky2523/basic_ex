<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'รายการครุภัณฑ์-Filter ComboBox';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-index4">
    <div class="panel panel-info">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-list-alt"></i> 
               <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล', ['create'],
                ['class' => 'btn btn-success']) ?>
    </p>
    <div class="pull-right">
        <?php
        $data = ArrayHelper::map(\app\models\Tooltypes::find()->all(), 'type_name', 'type_name');
        ?>
        
        <?= Html::dropDownList('tooltypes', null, $data,['prompt'=>'- เลือกประเภท -','onchange'=>'
                        $.pjax.reload({
                            url: "'.Url::to(['index4']).'&ToolsSearch[tooltype_id]="+$(this).val(),
                            container: "#pjax-gridview",
                            timeout: 1000,
                        });
                    ','class'=>'form-control']) ?>

    </div><br>
<?php Pjax::begin(['id' => 'pjax-gridview']) ?>
    <?php 
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',            
            [
                'attribute'=>'pictool',
                'format'=>'html',
                'value'=>function($model){
                    return html::img('pictools/'.$model->pictool,['class'=>'thumbnail-responsive',
                        'style'=>'width: 80px;']);
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
                  
//            'buydate',
//            'okdate',
//             'yearbudget',
//             'company_id',
//             'price',
//             'budget',
//             'serial',
//             'model',
//             'wardate',             
//             'howbuy',
//             'exprie',
//             'expriedate',
//             'expriecase',                         
            // 'user_id',
            // 'regdate',
            // 'updatedate',
                    

            [
            'class' => 'yii\grid\ActionColumn',
            'options'=>['style'=>'width:140px;'],
            'buttonOptions'=>['class'=>'btn btn-default'],
            'template'=>'<div class="btn-group btn-group-sm text-center" role="group">
                            {view} {update} {delete} </div>'
         ],
                  ],
    ]); ?>
<?php Pjax::end() ?>
        </div> 
    </div>        
</div>

