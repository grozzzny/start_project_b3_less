<?php

use yii\db\Migration;

/**
 * Class m200619_083859_init
 */
class m200619_083859_init extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    public function up()
    {
        $this->createTable('teames', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'name' => $this->string(),
            'image' => $this->string(),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);
        $this->createIndex('i_owner_id', 'teames', 'owner_id');
        $this->addForeignKey('fk_owner_user', '{{%teames}}', 'owner_id', '{{%user}}', 'id', 'SET NULL');


        $this->createTable('locations', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'loaction_id' => $this->integer(),
            'time_from' => $this->integer(),
            'time_to' => $this->integer(),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);
        $this->createIndex('i_loaction_id', 'events', 'loaction_id');
        $this->addForeignKey('fk_loaction', '{{%events}}', 'loaction_id', '{{%locations}}', 'id', 'SET NULL');


        $this->createTable('rating', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'team_id' => $this->integer(),
            'value' => $this->integer(),
        ], $this->engine);
        $this->createIndex('i_event_id', 'rating', 'event_id');
        $this->createIndex('i_team_id', 'rating', 'team_id');
        $this->addForeignKey('fk_team', '{{%rating}}', 'team_id', '{{%teames}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_event', '{{%rating}}', 'event_id', '{{%events}}', 'id', 'CASCADE');
    }

    public function down()
    {
        echo "m200619_083859_init cannot be reverted.\n";

        return false;
    }
}
