<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "draw_rel_team_season".
 *
 * @property integer $id
 * @property integer $team_id
 * @property integer $season_id
 */
class DrawRelTeamSeason extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'draw_rel_team_season';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_id', 'season_league_id'], 'required'],
            [['team_id', 'season_league_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'team_id' => Yii::t('app', 'Team ID'),
            'season_league_id' => Yii::t('app', 'Season ID'),
        ];
    }
}
