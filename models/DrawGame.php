<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "draw_game".
 *
 * @property integer $id
 * @property integer $team_home_id
 * @property integer $team_guest_id
 * @property integer $team_home_first_half_goals
 * @property integer $team_guest_first_half_goals
 * @property integer $team_home_second_half_goals
 * @property integer $team_guest_second_half_goals
 * @property integer $team_home_goals
 * @property integer $team_guest_goals
 * @property string $result_firs_half
 * @property string $result_second_half
 * @property string $result_amount
 * @property integer $result
 * @property integer $season_id
 * @property integer $league_id
 * @property integer $date
 */
class DrawGame extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'draw_game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_home_id', 'team_guest_id', 'result_firs_half', 'result_second_half', 'result_amount', 'season_league_id', 'date'], 'required'],
            [['team_home_id', 'team_guest_id', 'team_home_first_half_goals', 'team_guest_first_half_goals', 'team_home_second_half_goals', 'team_guest_second_half_goals', 'team_home_goals', 'team_guest_goals', 'result', 'season_league_id', 'date'], 'integer'],
            [['result_firs_half', 'result_second_half', 'result_amount'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'team_home_id' => Yii::t('app', 'Team Home ID'),
            'team_guest_id' => Yii::t('app', 'Team Guest ID'),
            'team_home_first_half_goals' => Yii::t('app', 'Team Home First Half Goals'),
            'team_guest_first_half_goals' => Yii::t('app', 'Team Guest First Half Goals'),
            'team_home_second_half_goals' => Yii::t('app', 'Team Home Second Half Goals'),
            'team_guest_second_half_goals' => Yii::t('app', 'Team Guest Second Half Goals'),
            'team_home_goals' => Yii::t('app', 'Team Home Goals'),
            'team_guest_goals' => Yii::t('app', 'Team Guest Goals'),
            'result_firs_half' => Yii::t('app', 'Result Firs Half'),
            'result_second_half' => Yii::t('app', 'Result Second Half'),
            'result_amount' => Yii::t('app', 'Result Amount'),
            'result' => Yii::t('app', 'Result'),
            'season_league_id' => Yii::t('app', 'Season ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
