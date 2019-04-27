<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190424_113016_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'creator_id' => $this->integer(),
            'responsible_id' => $this->integer(),
            'deadline' => $this->date(),
            'status_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);


        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'login' =>$this->string(50)->notNull(),
            'password' => $this->string(20)->notNull(),
            'email' => $this->string()
        ]);
        $this->addForeignKey('fk_task_creator_user', "tasks", "creator_id", "users", "id" );
        $this->addForeignKey('fk_task_responsible_user', "tasks", "responsible_id", "users", "id" );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task');
        $this->dropTable('{{%users}}');

    }
}
