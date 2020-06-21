<?php

use yii\db\Migration;

/**
 * Class m200620_221439_add
 */
class m200620_221439_add extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('league', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'active' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->addColumn('locations', 'active', $this->boolean()->defaultValue(false));
        $this->addColumn('events', 'league_id', $this->integer());
        $this->addColumn('events', 'code', $this->integer());


        $this->createTable('teames_events_rel', [
            'team_id' => $this->integer(),
            'event_id' => $this->integer(),
        ], $this->engine);

        $this->createIndex('unique_team_event', 'teames_events_rel', ['team_id','event_id'], true);
        $this->addForeignKey('fk_team_rel', '{{%teames_events_rel}}', 'team_id', '{{%teames}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_event_rel', '{{%teames_events_rel}}', 'event_id', '{{%events}}', 'id', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200620_221439_add cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200620_221439_add cannot be reverted.\n";

        return false;
    }
    */
}
