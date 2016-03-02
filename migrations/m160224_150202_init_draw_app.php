<?php

use yii\db\Migration;
use yii\db\Schema;

class m160224_150202_init_draw_app extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    public function up()
    {
        //COUNTRY
        $this->createTable('draw_country', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . '(128) NOT NULL',
            'slug' => Schema::TYPE_STRING . '(128) NOT NULL',
        ], $this->engine);

        //LEAGUE
        $this->createTable('draw_league', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . '(128) NOT NULL',
            'slug' => Schema::TYPE_STRING . '(128) NOT NULL',
        ], $this->engine);

        //SEASON
        $this->createTable('draw_season', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . '(128) NOT NULL',
            'start' => Schema::TYPE_STRING . '(64)',
            'end' => Schema::TYPE_STRING . '(64)',
            'slug' => Schema::TYPE_STRING . '(128) NOT NULL',
        ], $this->engine);

        //LEAGUE_SEASON
        $this->createTable('draw_rel_league_season', [
            'id' => 'pk',
            'name_league' => Schema::TYPE_STRING . '(128)',
            'country_id' => Schema::TYPE_INTEGER . " NOT NULL",
            'league_id' => Schema::TYPE_INTEGER . " NOT NULL",
            'season_id' => Schema::TYPE_INTEGER . " NOT NULL",
        ], $this->engine);

        //TEAM
        $this->createTable('draw_team', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . '(128) NOT NULL',
            'slug' => Schema::TYPE_STRING . '(128) NOT NULL',
            'country_id' => Schema::TYPE_INTEGER . " NOT NULL",
        ], $this->engine);

        //LEAGUE_SEASON
        $this->createTable('draw_rel_team_season', [
            'id' => 'pk',
            'team_id' => Schema::TYPE_INTEGER . " NOT NULL",
            'season_league_id' => Schema::TYPE_INTEGER . " NOT NULL",
        ], $this->engine);

        //GAME
        $this->createTable('draw_game', [
            'id' => 'pk',
            'team_home_id' => Schema::TYPE_INTEGER . " NOT NULL",
            'team_guest_id' => Schema::TYPE_INTEGER . " NOT NULL",
            'team_home_first_half_goals' => Schema::TYPE_INTEGER,
            'team_guest_first_half_goals' => Schema::TYPE_INTEGER,
            'team_home_second_half_goals' => Schema::TYPE_INTEGER,
            'team_guest_second_half_goals' => Schema::TYPE_INTEGER,
            'team_home_goals' => Schema::TYPE_INTEGER,
            'team_guest_goals' => Schema::TYPE_INTEGER,
            'result_firs_half' => Schema::TYPE_STRING . '(64) NOT NULL',
            'result_second_half' => Schema::TYPE_STRING . '(64) NOT NULL',
            'result_amount' => Schema::TYPE_STRING . '(64) NOT NULL',
            'result' => Schema::TYPE_INTEGER,
            'season_league_id' => Schema::TYPE_INTEGER . " NOT NULL",
            'round'=> Schema::TYPE_INTEGER . " NOT NULL",
            'date'=> Schema::TYPE_INTEGER . " NOT NULL",
        ], $this->engine);


    }

    public function down()
    {
        $this->dropTable('draw_country');
        $this->dropTable('draw_league');
        $this->dropTable('draw_season');
        $this->dropTable('draw_rel_league_season');
        $this->dropTable('draw_team');
        $this->dropTable('draw_rel_team_season');
        $this->dropTable('draw_game');
    }
}