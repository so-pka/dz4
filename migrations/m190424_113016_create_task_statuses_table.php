<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_statuses}}`.
 */
class m190424_113016_create_task_statuses_table extends Migration
{
    protected $tableName = 'task_statuses';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)
        ]);

        $this->batchInsert($this->tableName, ['name'],
            [
                ['Новая'],
                ['В Работе'],
                ['Выполнена'],
                ['Тестирование'],
                ['Доработка'],
                ['Закрыта'],

            ]);

        $taskTable  = 'task';

        $this->addForeignKey('fk_task_statuses', $taskTable, "status_id", $this->tableName, "id" );
        $this->update($taskTable,['status_id => 1']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);

    }
}
