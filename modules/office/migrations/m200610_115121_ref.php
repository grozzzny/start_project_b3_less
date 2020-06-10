<?php

use yii\db\Migration;

/**
 * Class m200610_115121_ref
 */
class m200610_115121_ref extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('office_documents', 'consultation_id', $this->integer());
        $this->createIndex('i_consultation_id', 'office_documents', 'consultation_id');

        $this->addColumn('office_correspondence', 'consultation_id', $this->integer());
        $this->createIndex('i_consultation_id', 'office_correspondence', 'consultation_id');

        $this->addColumn('office_tasks', 'consultation_id', $this->integer());
        $this->createIndex('i_consultation_id', 'office_tasks', 'consultation_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200610_115121_ref cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200610_115121_ref cannot be reverted.\n";

        return false;
    }
    */
}
