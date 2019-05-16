<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 15.05.2019
 * Time: 23:47
 */


/**
 * @var $model \app\models\tables\Task
 */
?>

<div class="task" style="width: 445px; border: solid #2b669a">
    <a href="<?= \yii\helpers\Url::to(['task/one', 'id' => $model->id])?>" style="display: block; height: 100%">
        <div class="task-preview">
            <div class="task-preview-header"><?= $model->name?></div>
            <div class="task-preview-content"><?= $model->description?></div>
        </div>
    </a>
</div>
