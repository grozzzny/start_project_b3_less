<?php

use yii\db\Migration;

/**
 * Class m200609_153703_add_column
 */
class m200609_153703_add_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('office_clients', 'passport_code', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200609_153703_add_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200609_153703_add_column cannot be reverted.\n";

        return false;
    }
    */
}
