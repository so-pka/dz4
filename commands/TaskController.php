<?php
namespace app\commands;
//use app\models\Task;
use app\models\tables\Task;
use app\models\tables\Users;



class TaskController extends Controller
{
// public $message = 'hello';




    public function actionFindUrgent()
    {

        $tasks = Task::find()
            ->where('tasks.date, DATEDIFF(NOW()) = 1')
            ->with('responsible')
            ->all();
        foreach ($tasks as $task){

            \Yii::$app->mailer->compose()
                ->setTo($task->responsible->email)
                ->setFrom(['test@test.com' => 'Admin'])
                ->setSubject('истекает дата выполнения задачи')
                ->setTextBody("истекает дата выполнения задачи http://yii2?r=task/one&id={$task->id}")
                ->send();
        }
    }




      
    /**
     * Test
     */
//    public function actionTest($id)
//    {
//        if($user = Users::findOne($id)){
//            $this->stdout("{$this->message}, {$user->login}");
//            return self::EXIT_CODE_NORMAL;
//        }
//        return self::EXIT_CODE_ERROR;
//    }

    public function actionIndex()
    {
        echo "start";
        Console::startProgress(1, 100);
        for($i = 1; $i < 100; $i++){
            sleep(1);
            Console::updateProgress($i, 100);
        }
        Console::endProgress();
        echo "end";
    }


    public function options($actonId)
    {
        return [
            'message'
        ];
    }

    public function optionAliases()
    {
        return [
            'm' => 'message'
        ];
    }

}