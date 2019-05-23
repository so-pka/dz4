<?php

namespace app\controllers;
use Yii;
use app\models\tables\Task;
use app\models\filters\TasksFilter;
//use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\tables\Users;
use app\models\tables\TaskStatuses;
use app\models\forms\TaskAttachmentsAddForm;

use app\models\tables\TaskComments;

use yii\filters\VerbFilter;

use yii\web\UploadedFile;



class TaskController extends Controller
{

    public function actionIndex()
    {

        $searchModel = new TasksFilter();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }

    public function actionOne($id)
    {
        return $this->render('one', [
            'model' => Task::findOne($id),
            'usersList' => Users::GetUsersList(),
            'statusesList' => TaskStatuses::getList(),
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'userId' => \Yii::$app->user->id,
         ]);
    }


    public function actionView($id)
    {
        return $this->render('_form', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionSave($id)
    {
        if($model = Task::findOne($id)){
            $model->load(\Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', "Изменения сохранены");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }


    public function actionAddComment()
    {
        $model = new TaskComments();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', "Комментарий добавлен!");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddAttachment()
    {
        $model = new TaskAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->attachment = UploadedFile::getInstance($model, 'attachment');
        if ($model->save()) {
            \Yii::$app->session->setFlash('success', "Файл добавлен!");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить Файл");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

}
