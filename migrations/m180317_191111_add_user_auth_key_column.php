<?php

use yii\db\Migration;

/**
 * Class m180317_191111_add_user_auth_key_column
 */
class m180317_191111_add_user_auth_key_column extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%user}}', 'auth_key', $this->string(32)->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'auth_key');
    }

}
