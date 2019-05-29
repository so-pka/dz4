<?php


namespace app\components;


use app\models\tables\Task;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

class Bootstrap extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->setLanguageSettings();
       $this->attachEventsHandlers();
    }

    private function setLanguageSettings(){
        if($lang = \Yii::$app->session->get('lang')){
            \Yii::$app->language = $lang;
        }
    }

    private function attachEventsHandlers(){
        Event::on(Task::class, Task::EVENT_AFTER_INSERT, function($event){
            /** @var Task $task */
            $task = $event->sender;
            $user = $task->responsible;

            $body = "New task {$task->name}.
             link: http://yii.uni.local?r=task/one&id={$task->id}
           ";

            \Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom('admin@test.ru')
                ->setSubject("New task")
                ->setTextBody($body)
                ->send();
        });

    }

    }