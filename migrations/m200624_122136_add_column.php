<?php

use yii\db\Migration;

/**
 * Class m200624_122136_add_column
 */
class m200624_122136_add_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('teames', 'phone', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200624_122136_add_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200624_122136_add_column cannot be reverted.\n";

        return false;
    }
    */
}
