<?php

namespace app\controllers;

class BaseController extends \yii\web\Controller
{
    public function actionLoaddistrict()
    {
        return $this->render('loaddistrict');
    }

    public function actionLoadtambon()
    {
        return $this->render('loadtambon');
    }

}
