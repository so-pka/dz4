<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
class TaskVidget extends Widget
{
    public $descr = "500px";
    public $title = "sdsfs";
    public $model;
    public $id;


    public function run()
    {
            return $this->render("TaskVidget",
            [
                'title' => $this->title,
                'descr' => $this->descr,
                'id' => $this->id,
            ]
        );
    }
}