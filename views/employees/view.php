<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */

$this->title = $model->fname . ' ' . $model->lname;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-view">

    <div class="panel panel-primary">
        <div class="panel-heading"><h3><i class="glyphicon glyphicon-search"></i> 
                ข้อมูลส่วนตัว คุณ : <?= Html::encode($this->title) ?></h3></div>
        <div class="panel-body">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </p>

            <div> <?= Html::img('avatars/' . $model->avatar, ['class' => 'thumbnail img-responsive', 'width' => '150px;']) ?></div>

            <?=
            DetailView::widget([
                'model' => $model,
                'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
                'attributes' => [
                    // 'id',
                    'cid',
                    [
                        'attribute' => 'fname',
                        'label' => 'ชื่อ-สกุล',
                        'value' => $model->pname . '' . $model->fname . ' ' . $model->lname
                    ],
                    [
                        'attribute' => 'sex',
                        'value' => $model->sex == '1' ? "ชาย" : "หญิง"
                    ],
                    'birthdate',
                    'address',
                    [
                        'attribute' => 'tumbon',
                        'value' => $model->distict->DISTRICT_NAME
                    ],
                    [
                        'attribute' => 'ampur',
                        'value' => $model->amphur->AMPHUR_NAME
                    ],
                    [
                        'attribute' => 'chw',
                        'value' => $model->prov->PROVINCE_NAME
                    ],
                    'education',
                    'ability',
                    'tel',
                    'comein',
                    'avatar',
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => $model->status == '1' ? "<i class=\"glyphicon glyphicon-ok\"></i>" :
                                "<i class=\"glyphicon glyphicon-remove\"></i>",
                    ],
                ],
            ])
            ?>

        </div> 
    </div>        
</div>
