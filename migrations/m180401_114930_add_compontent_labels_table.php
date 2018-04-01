<?php

use yii\db\Migration;

/**
 * Class m180401_114930_add_compontent_labels_table
 */
class m180401_114930_add_compontent_labels_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%component_labels}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'assignId' => $this->integer()->unsigned(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%component_labels}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180401_114930_add_compontent_labels_table cannot be reverted.\n";

        return false;
    }
    */
}
