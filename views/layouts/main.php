<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\MaterialAsset;

//AppAsset::register($this);
MaterialAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yii2 Easy Learn',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels'=>false,
        'items' => [
            ['label' => 'หน้าหลัก', 'url' => ['/site/index']],
            ['label' => 'รายชื่อสมาชิก', 'url' => ['/employees/index']],
            ['label' => 'แผนก', 'url' => ['/departments/index']],
            ['label' => 'กลุ่มงาน', 'url' => ['/groups/index']],
            ['label' => '<i class="glyphicon glyphicon-wrench"></i> ระบบครุภัณฑ์','visible'=>!Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> รายการครุภัณฑ์', 'url' => ['/tools/index']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> สอบเทียบ', 'url' => ['/cals/index']],                            
                        ]
                    ],
            ['label' => '<i class="glyphicon glyphicon-indent-left"></i> รายงาน','visible'=>!Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => '<i class="glyphicon glyphicon-indent-left"></i> ค่าเสื่อมราคา', 'url' => ['/tools/report1']],
                            ['label' => '<i class="glyphicon glyphicon-indent-left"></i> การสอบเทียบ-ช่วงเวลา', 'url' => ['/cals/report2']],
                            ['label' => '<i class="glyphicon glyphicon-indent-left"></i> รายการครุภัณฑ์-แยกตามประเภท', 'url' => ['/tools/toollists']],
                        ]
                    ],
            ['label' => '<i class="glyphicon glyphicon-search"></i> บทเรียน','visible'=>!Yii::$app->user->isGuest,
                        'items' => [                            
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> GridView Export', 'url' => ['/tools/index1']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> Modal on GridView', 'url' => ['/tools/index2']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> Editable GridView', 'url' => ['/tools/index3']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> Filter ComboBox', 'url' => ['/tools/index4']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> Grouping Sigle Column', 'url' => ['/tools/index5']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> Modal Show Detail', 'url' => ['/tooltypes/index']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> Hichart-Filter with Value', 'url' => ['/tools/toollists']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> Expand Grid-DynamicForm', 'url' => ['/cals/index']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> Datepicker on GridView', 'url' => ['/cals/index1']],
                            ['label' => '<i class="glyphicon glyphicon-hand-right"></i> DatepickerRange on GridView', 'url' => ['/cals/index2']],
                        ]
                    ],
            Yii::$app->user->isGuest ?
                            ['label' => '<i class="glyphicon glyphicon-user"></i> ลงชื่อใช้งาน', 'url' => ['/user/security/login']] :
                            ['label' => '<i class="glyphicon glyphicon-user"></i> (' . Yii::$app->user->identity->username . ')', 
                                'items' => [
                                ['label' => 'ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile']],
                                ['label' => 'Account', 'url' => ['/user/settings/account']],
                                ['label' => 'ออกจากระบบ','url' =>['/user/security/logout'],'linkOptions' =>['data-method' =>'post']],
                        ]],
                    ['label' => '<i class="glyphicon glyphicon-pencil"></i> ลงทะเบียน', 'url' => ['/user/registration/register'],
                        'visible' => Yii::$app->user->isGuest],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="margin-top: 80px;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        <?= $content ?>
          
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
