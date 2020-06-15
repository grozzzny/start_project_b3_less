<?php

use yii\db\Migration;

/**
 * Class m200615_085432_after_column
 */
class m200615_085432_after_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('office_case', 'civil_court', $this->integer());
        $this->alterColumn('office_case', 'criminal_court', $this->integer());
        $this->alterColumn('office_case', 'administrative_court', $this->integer());

        $this->renameColumn('office_case', 'civil_court', 'civil_court_id');
        $this->renameColumn('office_case', 'criminal_court', 'criminal_court_id');
        $this->renameColumn('office_case', 'administrative_court', 'administrative_court_id');

        $this->createIndex('i_civil_court_id', 'office_case', 'civil_court_id');
        $this->createIndex('i_criminal_court_id', 'office_case', 'criminal_court_id');
        $this->createIndex('i_administrative_court_id', 'office_case', 'administrative_court_id');
        $this->createIndex('i_court_id', 'office_documents', 'court_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200615_085432_after_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200615_085432_after_column cannot be reverted.\n";

        return false;
    }
    */
}
