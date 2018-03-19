<?php

use yii\db\Migration;

/**
 * Handles the creation of table `deal`.
 */
class m180319_152659_create_deal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%deals}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'promptly' => $this->smallInteger(),
            'priority' => $this->smallInteger(),
            'end_date' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-app_deals-user_id}}', '{{%deals}}', 'user_id');
        $this->createIndex('{{%idx-app_deals-task_id}}', '{{%deals}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deals}}');
    }
}
