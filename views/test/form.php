<?php
//* var \app\models\tables\Test $model */
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
$form = ActiveForm::begin();

echo $form->field($model, 'description')->TextInput();
echo $form->field($model, 'title')->TextInput();
echo Html::submitButton("Send", ["class"=>'btn-success']);

ActiveForm::end();