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


use yii\filters\VerbFilter;





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

}
