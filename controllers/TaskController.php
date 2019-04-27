<?php

namespace app\controllers;
use app\models\tables\Task;
//use app\models\Task;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class TaskController extends Controller
{
    public function actionIndex()
    {

        $model = new Task();

        $model->setAttributes([
            'title' => 'Знакомство',
            'description' => 'Описание',
            'status' => 'Тестируется',
            'author' => 1,
            'responsible' => 200,
        ]);

        //var_dump($model->toArray());
        //var_dump($model);
        //exit;

        return $this->render('task', [
            'title' => 'Привет, тут будет форма задачи',
            'content' => 'форма задачи'
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


}
