<?php

namespace app\controllers\backend;

use Yii;
use app\models\DrawCountry;
use app\models\DrawGame;
use app\models\DrawLeague;
use app\models\DrawRelLeagueSeason;
use app\models\DrawRelTeamSeason;
use app\models\DrawSeason;
use app\models\DrawTeam;

use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class DrawChartController extends BackendController
{


    public function actionIndex()
    {
        $country = DrawCountry::find()->where(['id'=>1])->one();
        $league = DrawLeague::find()->where(['name'=>'D1'])->one();
        $season = DrawSeason::find()->where(['slug'=>'201415'])->one();

        $league_season = null;
        if($country && $league && $season){
            $league_season = DrawRelLeagueSeason::find()->where(['league_id'=>$league->id, 'season_id'=>$season->id, 'country_id'=>$country->id])->one();
        }

        if($league_season){

            $games_season = DrawGame::find()->where(['season_league_id'=>$league_season->id])->orderBy(['round'=>SORT_ASC])->all();
            $round_count =  DrawGame::find()->where(['season_league_id'=>$league_season->id])->groupBy('round')->count();

            if(!empty($games_season)){

                $put_sum_all = 0;
                $win_sum_all = 0;

                $put_sum = 1;
                $win_sum = 0;

                $array_all_sum = [];
                for($i=1;  $i<=$round_count; $i++){
                    $array_all_sum[$i]['put_sum']=0;
                    $array_all_sum[$i]['win_sum']=0;
                }

                $array_all_sum['put_sum_all']= 0;
                $array_all_sum['win_sum_all']= 0;

                foreach($games_season as $key=>$game){

                    if($game->result){

                        $array_all_sum['put_sum_all'] += $put_sum;
                        $array_all_sum[$game->round]['put_sum'] += $put_sum;
                        $put_sum = $put_sum*2;

                    }else{
                        $win_sum = $win_sum+($start_sum*3);
                        $all_pay_sum = $all_pay_sum+$start_sum;
                        $start_sum = 1;
                    }
                        $array_all_sum[$game->round]['all_sum'] = $put_sum;


                        foreach($games_team as $kk=>$game){



                        }
                        $win_sum_all = $win_sum_all+$win_sum;
                        $all_pay_sum_all = $all_pay_sum_all+$all_pay_sum;
                        echo "<pre>";
                        var_dump($team->name);
                        var_dump($all_pay_sum, $win_sum);
                        echo "----------------------------------------------------------------------------------------";
                        echo "</pre>";

                }
            }

        }
exit;
        return $this->render('index');
    }
}
