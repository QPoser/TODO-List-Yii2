<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m180325_060706_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer()->unsigned(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('{{%fk-app_deals-task_id}}', '{{%deals}}', 'task_id', '{{%tasks}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-app_deals-task_id}}', '{{%deals}}');
        $this->dropTable('{{%tasks}}');
    }
}
