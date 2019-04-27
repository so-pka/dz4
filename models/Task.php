<?php

namespace app\models;

use yii\base\Model;
use app\validators\taskvalidator;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\base\Event;


use Yii;
//use yii\base\Event;
//use yii\db\ActiveRecord;

class Task extends Model
{
    public $title;
    public $description;
    public $author;
    public $responsible;
    public $status;

       public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 10],
            [['status'], TaskValidator::className()],
            [['author', 'responsible', 'created_at', 'updated_at'], 'safe']

        ];
    }


    public function fields()
    {
        return [
            'header' => 'title',
            'description'
        ];
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()')
            ],
        ];
    }


    public function init(){
        $this->on(ActiveRecord::EVENT_AFTER_INSERT, [$this, 'sendMail']);
        parent::init();
    }

    public function sendMail(){
        Yii::$app->mailer->compose()
            ->setTo('test@test.com')
            ->setFrom(['test@test.com' => 'Admin'])
            ->setSubject('вам поставлена задача')
            ->setTextBody('текст задачи')
            ->send();

    }



}