<?php

use yii\db\Migration;

/**
 * Class m200610_215947_add
 */
class m200610_215947_add extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('office_employee', 'full_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200610_215947_add cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200610_215947_add cannot be reverted.\n";

        return false;
    }
    */
}
