<?php

use yii\db\Migration;

/**
 * Class m200608_194113_add_columns
 */
class m200608_194113_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('office_account', 'active', $this->boolean()->defaultValue(true));
        $this->addColumn('office_account', 'active_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200608_194113_add_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200608_194113_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
