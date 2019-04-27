<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="task-view">

    <?= \app\widgets\TaskVidget::widget([
        'title' => $model->name,
        'descr' => $model->description,
        'id' => $model->id,
    ]);?>


</div>
