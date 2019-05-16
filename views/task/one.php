<?php


use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;
?>

<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]);?>
        <?=$form->field($model, 'name')->textInput();?>
         <div class="row">
            <div class="col-lg-4">
                <?=$form->field($model, 'status')
                    ->dropDownList($statusesList)?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'responsible')
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
        <?=Html::submitButton("Сохранить",['class' => 'btn btn-success']);?>
       <?ActiveForm::end()?>
    </div>
</div>
