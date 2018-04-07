<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 07.04.2018
 * Time: 10:09
 */

namespace app\components;


use yii\db\Migration;

// MIGRATION FOR COMPONENT

class LabelMigration extends Migration
{

    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%component_labels}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'assignId' => $this->integer()->unsigned(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%component_labels}}');
    }

}