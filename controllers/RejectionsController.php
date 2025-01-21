<?php

namespace app\controllers;

use app\models\Application;
use app\models\AdminController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Rejections;
use Yii;

class RejectionsController extends Controller
{

    public function actionCreate($id_application)
    {
        $model = new Rejections();

        try {
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    $userRequest = Application::findOne($id_application);
                    $userRequest->status = "Услуга отклонена";
                    $userRequest->save();
                    Yii::$app->session->setFlash('success', 'Статус изменен на "Отменено".');
                    return $this->redirect(['application/view', 'id' => $id_application]);
                }
            } else {
                $model->loadDefaultValues();
            }
        } catch (\yii\db\IntegrityException $e) {
            Yii::$app->session->setFlash('danger', 'Уже отменено');
            return $this->redirect(['application/view', 'id' => $id_application]);
        }

        return $this->render('create', [
            'model' => $model, 'id' => $id_application
        ]);
    }

    
    public static function deleteRejection($request_id)
    {
        // При смене статуса на "В работе" или "Выполнено"
        // удалить соответствующую заявке запись 
        // из таблицы rejection.
        // Иначе впоследствии не сможем сменить на "Отменено": связь один-к-одному
        // не даст создать новый экземпляр класса Rejection.
        
        $rejection = Rejections::findOne($request_id);        
        
        if ($rejection) {
            $rejection->delete();
        }
    }
}
?>






