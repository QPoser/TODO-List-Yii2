<?php

use yii\db\Migration;

/**
 * Class m180320_154704_add_deal_completed_column
 */
class m180320_154704_add_deal_completed_column extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%deals}}', 'complete', $this->smallInteger()->defaultValue(0)->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%deals}}', 'complete');
    }
}
