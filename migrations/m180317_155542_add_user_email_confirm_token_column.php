<?php

use yii\db\Migration;

/**
 * Class m180317_155542_add_user_email_confirm_token_column
 */
class m180317_155542_add_user_email_confirm_token_column extends Migration
{

    public function up()
    {
        $this->addColumn('{{%user}}', 'email_confirm_token', $this->string()->unique());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'email_confirm_token');
    }
}
