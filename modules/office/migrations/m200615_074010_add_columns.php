<?php

use yii\db\Migration;

/**
 * Class m200615_074010_add_columns
 */
class m200615_074010_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('office_case', 'civil_plaintiff', $this->string());
        $this->addColumn('office_case', 'civil_respondent', $this->string());
        $this->addColumn('office_case', 'civil_subject_dispute', $this->string());
        $this->addColumn('office_case', 'civil_court', $this->string());

        $this->addColumn('office_case', 'criminal_suspect', $this->string());
        $this->addColumn('office_case', 'criminal_victim', $this->string());
        $this->addColumn('office_case', 'criminal_essence_charge', $this->string());
        $this->addColumn('office_case', 'criminal_stage', $this->string());
        $this->addColumn('office_case', 'criminal_court', $this->string());

        $this->addColumn('office_case', 'execution_recoverer', $this->string());
        $this->addColumn('office_case', 'execution_debtor', $this->string());
        $this->addColumn('office_case', 'execution_bailiff_service', $this->string());
        $this->addColumn('office_case', 'execution_subject_execution', $this->string());

        $this->addColumn('office_case', 'administrative_plaintiff', $this->string());
        $this->addColumn('office_case', 'administrative_respondent', $this->string());
        $this->addColumn('office_case', 'administrative_offender', $this->string());
        $this->addColumn('office_case', 'administrative_court', $this->string());
        $this->addColumn('office_case', 'administrative_subject_dispute', $this->string());

        $this->addColumn('office_case', 'instruction_essence_order', $this->string());
        $this->addColumn('office_case', 'instruction_applicant', $this->string());

        $this->dropColumn('office_case', 'object_category');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200615_074010_add_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200615_074010_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
