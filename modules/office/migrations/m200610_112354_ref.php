<?php

use yii\db\Migration;

/**
 * Class m200610_112354_ref
 */
class m200610_112354_ref extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('office_documents', 'relation', $this->string());
        $this->addColumn('office_correspondence', 'relation', $this->string());
        $this->addColumn('office_tasks', 'relation', $this->string());
        $this->addColumn('office_transaction', 'relation', $this->string());

        $this->addColumn('office_comments', 'relation', $this->string());
        $this->addColumn('office_comments', 'consultation_id', $this->integer());
        $this->addColumn('office_comments', 'session_id', $this->integer());
        $this->createIndex('i_consultation_id', 'office_comments', 'consultation_id');
        $this->createIndex('i_session_id', 'office_comments', 'session_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200610_112354_ref cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200610_112354_ref cannot be reverted.\n";

        return false;
    }
    */
}
