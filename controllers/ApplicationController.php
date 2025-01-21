<?php

namespace app\controllers;

use app\models\Application;
use app\models\ApplicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * ApplicationController implements the CRUD actions for Application model.
 */
class ApplicationController extends Controller
{
    public function actionOnprogress ($id_application)
    {
        // Меняет статус заявки на "В работе"
        
        if (!Yii::$app->user->identity->isAdmin()) {
            throw new ForbiddenHttpException("Запрет.");
        }
        
        $model = $this->findModel($id_application);
        $model->status = "В работе";
        
        RejectionsController::deleteRejection($id_application);
        
        if ($model->save()){
            Yii::$app->session->setFlash('success', 'Статус изменен на ' . $model->status . '.');    
        } else {
            Yii::$app->session->setFlash('danger', 'Не удалось изменить статус.');    
        }
        
        return $this->redirect(['view', 'id' => $model->id_application]);
    }
    

    public function actionFinish ($id_application)
    {
        // Меняет статус заявки на "Выполнено"
        
        if (!Yii::$app->user->identity->isAdmin()) {
            throw new ForbiddenHttpException();
        }
        
        
        $model = $this->findModel($id_application);
        $model->status = "Услуга оказана";
        
        RejectionsController::deleteRejection($id_application);
        
        if ($model->save()){
            Yii::$app->session->setFlash('success', 'Статус изменен на ' . $model->status . '.');    
        } else {
            Yii::$app->session->setFlash('danger', 'Не удалось изменить статус. <br>' . var_dump($model->errors));    
        }
        
        return $this->redirect(['view', 'id' => $model->id_application]);
    }
    public function beforeAction($action)
    {
    if (Yii::$app->user->isGuest) {
    $this -> redirect(['/site/login']);
    return false;
    }
   
    if (!parent::beforeAction($action)) {
    return false;
    }
   
    return true; // or false to not run the action
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Application models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ApplicationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Application model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Application();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_application]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Application model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Application model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne(['id_application' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
