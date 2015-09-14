<?php

namespace rzani\yii2\sqlogger\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{

    public $layout = 'main';

    public function actionIndex()
    {
	return $this->render('index');
    }

}
