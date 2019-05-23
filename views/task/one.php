<?php


use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;
/**@var \app\models\tables\Task $model */
/**@var \app\models\tables\TaskComments $taskCommentForm */
/**@var \app\models\forms\TaskAttachmentsAddForm $taskAttachmentForm */
?>

<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]);?>
        <?=$form->field($model, 'name')->textInput();?>
         <div class="row">
            <div class="col-lg-4">
                <?=$form->field($model, 'status_id')
                    ->dropDownList($statusesList)?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'responsible_id')
                    ->dropDownList($usersList)?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'deadline')
                    ->textInput(['type' => 'date'])?>
            </div>
        </div>
        <div>
            <?=$form->field($model, 'description')
                ->textarea()?>
        </div>

        <?= \yii\helpers\Html::submitButton("Сохранить", ['class' => 'btn btn-success']); ?>
       <?ActiveForm::end()?>
    </div>



    <div class="attachments">
        <h3>Вложения</h3>
        <?php $form = ActiveForm::begin([
            "action" => Url::to(['task/add-attachment']),
            'options' => ['class' => 'form-inline']
        ]);?>
        <?=$form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false);?>
        <?=$form->field($taskAttachmentForm, 'attachment')->fileInput()?>
        <?=\yii\helpers\Html::submitButton("Добавить", ['class' => 'btn btn-default']);?>
        <?php ActiveForm::end()?>
        <hr>
        <div class="attachmetns-history">
            <?php foreach ($model->taskAttachments as $file): ?>
                <a href="/img/tasks/<?= $file->path ?>">
                    <img src="/img/tasks/small/<?=$file->path ?>" alt="">
                </a>
            <?php endforeach; ?>
        </div>


        <h3>Комментарии</h3>
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/add-comment'])]); ?>
        <?=$form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false);?>
        <?=$form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false);?>
        <?=$form->field($taskCommentForm, 'content')->textInput()?>
        <?=\yii\helpers\Html::submitButton("Добавить", ['class' => 'btn btn-default']);?>
        <?php ActiveForm::end() ?>
        <hr>
        <div class="comment-history">
            <?php foreach ($model->taskComments as $comment): ?>
                <p>
                    <strong><?= $comment->user->login ?></strong>
                    <?= $comment->content ?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>



</div>
