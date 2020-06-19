<?php

use yii\db\Migration;

/**
 * Class m200619_103612_add_column
 */
class m200619_103612_add_column extends Migration
{

    public function up()
    {
        $this->addColumn('events', 'image', $this->string());
    }

    public function down()
    {
        echo "m200619_103612_add_column cannot be reverted.\n";

        return false;
    }

}
