<?php

namespace app\controllers;

use app\models\category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\ForbiddenHttpException;

class AdminController extends  AdminAccessController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}