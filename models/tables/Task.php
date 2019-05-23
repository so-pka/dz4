<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property int $responsible_id
 * @property string $deadline
 * @property int $status_id
 *
 * @property Test $status
 * @property Users $responsible
 * @property TaskComments[] $taskComments
 * @property TaskAttachments[] $taskAttachments
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['creator_id', 'responsible_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['deadline', 'created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t("app", "task_name"),
           //'description' => 'Description',
            'description' => Yii::t("app", "task_description"),
           // 'creator_id' => 'Creator ID',
            'creator_id' => Yii::t("app", "task_creator"),
            'responsible_id' => 'Responsible ID',
            'deadline' => 'Deadline',
          // 'status_id' => 'Status ID',
            'status_id' => Yii::t("app", "task_status"),
            'created_at' => 'Created at',
            'updated_at' => 'Updated at'
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::className(), ['id' => 'status_id']);
    }


    public function getResponsible()
    {
        return $this->hasOne(Users::className(), ["id" => "responsible_id"]);
    }

    public function getTaskComments()
    {
        return $this->hasMany(TaskComments::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachments::className(), ['task_id' => 'id']);
    }


}
