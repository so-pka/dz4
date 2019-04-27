<?php


namespace app\validators;

use yii\validators\validator;

class TaskValidator extends Validator
{
    public function validateAttributes($model, $attributes = null)
    {
        if(!in_array($this->$attributes, ['В работе', 'Закрыта'])){
           $this->addError($attributes, 'Неверный статус');
        }
    }


    public function validateAttribute($model, $attribute)
    {

        if(!in_array($this->$attribute, ['В работе', 'Закрыта'])){
            $this->addError($attribute, 'Неверный статус');
        }


    }

}
