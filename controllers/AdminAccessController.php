<?php

namespace app\controllers;

use app\models\category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\ForbiddenHttpException;

class AdminAccessController extends Controller
{
    public function beforeAction($action)
 {

if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
    throw new ForbiddenHttpException();
    }   
 if (!parent::beforeAction($action)) {
 return false;
 }

 // other custom code here

 return true; // or false to not run the action
 }

}