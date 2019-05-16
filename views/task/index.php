<?php
use yii\helpers\Html;
use yii\grid\GridView;



$form = \yii\widgets\ActiveForm::begin(['method' => 'get']); ?>

  <div class="form-group">




<?= Html::dropDownList('month',[],
          [
              '1' => 'январь',
              '2' => 'февраль',
              '3' => 'март',
              '4' => 'апрель',
              '5' => 'май',
              '6' => 'июнь',
              '7' => 'июль',
              '8' => 'август',
              '9' => 'сентябрь',
              '10' => 'октябрь',
              '11' => 'ноябрь',
              '12' => 'декабрь',
          ]);
 ?>
  </div>

  <div class="form-group">
      <?= Html::submitButton('Выбрать', ['class' => 'btn btn-success']) ?>
  </div>

<?php \yii\widgets\ActiveForm::end();



echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function($model){
        return \app\widgets\TaskPreview::widget([
            'model' => $model
        ]);
    },
    'summary' => false,
    'options' => [
        'class' => 'preview-container'
    ]
]);
