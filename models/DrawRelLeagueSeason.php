<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "draw_rel_league_season".
 *
 * @property integer $id
 * @property integer $league_id
 * @property integer $season_id
 */
class DrawRelLeagueSeason extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'draw_rel_league_season';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['league_id', 'season_id'], 'required'],
            [['league_id', 'season_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'league_id' => Yii::t('app', 'League ID'),
            'season_id' => Yii::t('app', 'Season ID'),
        ];
    }
}
