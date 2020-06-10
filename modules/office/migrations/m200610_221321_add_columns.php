<?php

use yii\db\Migration;

/**
 * Class m200610_221321_add_columns
 */
class m200610_221321_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('office_tasks', 'confirmed', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200610_221321_add_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200610_221321_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
