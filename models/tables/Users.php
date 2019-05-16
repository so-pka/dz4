<?php

namespace app\models\tables;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord
{

    const SCENARIO_AUTH = 'auth';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required', 'on' => static::SCENARIO_AUTH],
            [['login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
        ];
    }

    public function fields()
    {
        if ($this->scenario == static::SCENARIO_AUTH) {
            return [
                'id',
                'username' => 'login',
                'password'
            ];
        }
        return parent::fields();
    }

    public static function getUsersList()
    {
        $users = static::find()
            ->select(['id', 'login'])
            ->asArray()
            ->all();
        return ArrayHelper::map($users, 'id', 'login');
    }
}
