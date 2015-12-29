<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Calitems */

$this->title = 'Create Calitems';
$this->params['breadcrumbs'][] = ['label' => 'Calitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calitems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
