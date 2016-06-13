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

        $put_sum = 1;
        $coefficient = 2;
        $coefficient_game = 3;
        $round_start = 1;
        $round_end = 16;


        $league_season = null;
        if($country && $league && $season){
            $league_season = DrawRelLeagueSeason::find()->where(['league_id'=>$league->id, 'season_id'=>$season->id, 'country_id'=>$country->id])->one();
        }

        if($league_season){

            $games_season = DrawGame::find()->where(['season_league_id'=>$league_season->id])->orderBy(['round'=>SORT_ASC])->all();
            $round_count =  DrawGame::find()->where(['season_league_id'=>$league_season->id])->groupBy('round')->count();
            $rel_team_season = DrawRelTeamSeason::find()->where(['season_league_id'=>$league_season->id])->all();

            if(!empty($games_season)){

                $array_all_sum = [];
                /*for($i=1;  $i<=$round_count; $i++){
                    foreach($rel_team_season as $team_season){
                        $array_all_sum[$i][$team_season->team_id]['put_sum']=0;
                        $array_all_sum[$i][$team_season->team_id]['win_sum']=0;
                        $array_all_sum[$i][$team_season->team_id]['all_put_sum']=0;
                        $array_all_sum[$i][$team_season->team_id]['all_win_sum']=0;
                    }
                }*/

                /*$array_all_sum['put_sum_all']= 0;
                $array_all_sum['win_sum_all']= 0;*/

                foreach($games_season as $key=>$game){

                    if(!isset($array_all_sum[$game->round-1][$game->team_home_id]['put_sum'])){
                        $array_all_sum[$game->round][$game->team_home_id]['put_sum'] = $put_sum;
                    }

                    if(!isset($array_all_sum[$game->round-1][$game->team_guest_id]['put_sum'])){
                        $array_all_sum[$game->round][$game->team_guest_id]['put_sum'] = $put_sum;
                    }

                    /*$array_all_sum[$game->round][$game->team_home_id]['put_sum'] += $put_sum;
                    $array_all_sum[$game->round][$game->team_home_id]['win_sum'] += $put_sum;
                    $array_all_sum[$game->round][$game->team_home_id]['all_put_sum'] += $put_sum;
                    $array_all_sum[$game->round][$game->team_home_id]['all_win_sum'] += $put_sum;

                    $array_all_sum[$game->round][$game->team_guest_id]['put_sum'] += $put_sum;
                    $array_all_sum[$game->round][$game->team_guest_id]['win_sum'] += $put_sum;
                    $array_all_sum[$game->round][$game->team_guest_id]['all_put_sum'] += $put_sum;
                    $array_all_sum[$game->round][$game->team_guest_id]['all_win_sum'] += $put_sum;*/


                    if($game->result){
                        $array_all_sum[$game->round+1][$game->team_home_id]['put_sum'] = $array_all_sum[$game->round][$game->team_home_id]['put_sum']*$coefficient;
                        $array_all_sum[$game->round][$game->team_home_id]['win_sum'] = 0;
                    }else{
                        $array_all_sum[$game->round+1][$game->team_home_id]['put_sum'] = $put_sum;
                        $array_all_sum[$game->round][$game->team_home_id]['win_sum'] = $array_all_sum[$game->round][$game->team_home_id]['put_sum']*$coefficient_game;
                    }
                    $array_all_sum[$game->round+1][$game->team_home_id]['win_sum'] = 0;

                    if($game->result){
                        $array_all_sum[$game->round+1][$game->team_guest_id]['put_sum'] = $array_all_sum[$game->round][$game->team_guest_id]['put_sum']*$coefficient;
                        $array_all_sum[$game->round][$game->team_guest_id]['win_sum'] = 0;
                    }else{
                        $array_all_sum[$game->round+1][$game->team_guest_id]['put_sum'] = $put_sum;
                        $array_all_sum[$game->round][$game->team_guest_id]['win_sum'] = $array_all_sum[$game->round][$game->team_guest_id]['put_sum']*$coefficient_game;
                    }
                    $array_all_sum[$game->round+1][$game->team_guest_id]['win_sum'] = 0;

                }

                foreach($array_all_sum as $k=>$round){
                    if(($k>=$round_start) && ($k<=$round_end)){
                        $put_sum_round[$k]= 0;
                        $win_sum_round[$k]= 0;
                        foreach($round as $game){
                            $put_sum_round[$k]+= $game['put_sum'];
                            $win_sum_round[$k]+= $game['win_sum'];
                        }
                        echo "<pre>";
                        var_dump($put_sum_round[$k],$win_sum_round[$k]);
                        echo "</pre>";
                        echo '===================================';

                        array_slice($put_sum_round, 0, -1);
                        array_slice($win_sum_round, 0, -1);
                    }

                }

                $put_sum_all= 0;
                foreach($put_sum_round as $round){
                    $put_sum_all+=$round;
                }

                $win_sum_all= 0;
                foreach($win_sum_round as $round){
                    $win_sum_all+=$round;
                }

            }

        }

        echo "<pre>";
        var_dump($put_sum_all, $win_sum_all);
        echo "</pre>";
        die();

        $rounds = '';
        if(isset($round_count)){
            for($i=1; $i<=$round_count; $i++){
                $rounds.="'R".$i."',";
            }
            $rounds.="'P/W',";
        }

        $put_sum_all = '';
        $win_sum_all = '';
        foreach($array_all_sum as $key=>$sum){
            if($key != 'put_sum_all' && $key != 'win_sum_all'){
                $put_sum_all.= $sum['put_sum'].',';
                $win_sum_all.= $sum['win_sum'].',';
            }
            elseif($key == 'put_sum_all'){
                $put_sum_all.= $sum.',';
            }
            elseif($key == 'win_sum_all'){
                $win_sum_all.= $sum.',';
            }
        }

        return $this->render('index', [
            'array_all_sum'=>$array_all_sum,
            'put_sum_all'=>$put_sum_all,
            'win_sum_all'=>$win_sum_all,
            'rounds'=>$rounds,
        ]);

    }

    public function actionTeam()
    {
        $country = DrawCountry::find()->where(['id'=>1])->one();
        $league = DrawLeague::find()->where(['name'=>'D1'])->one();
        $season = isset($_POST['season_id']) ?  DrawSeason::findOne($_POST['season_id']) : DrawSeason::find()->where(['slug'=>'201415'])->one();
        $team =  isset($_POST['team_id']) ?  DrawTeam::findOne($_POST['team_id']) : DrawTeam::findOne(1);


        $put_sum = 1;
        $coefficient = 2;
        $coefficient_game = 3;
        $round_start = 1;
        $round_end = 16;


        $league_season = null;
        if($country && $league && $season){
            $league_season = DrawRelLeagueSeason::find()->where(['league_id'=>$league->id, 'season_id'=>$season->id, 'country_id'=>$country->id])->one();
        }

        if($league_season){

            if($team){
                $games_season = DrawGame::find()->where("(season_league_id =$league_season->id)  AND (team_home_id = $team->id OR team_guest_id = $team->id)")->orderBy(['round'=>SORT_ASC])->all();
            }else{
                $games_season = DrawGame::find()->where(['season_league_id'=>$league_season->id])->orderBy(['round'=>SORT_ASC])->all();
            }

            if(!empty($games_season)){

                $array_all_sum = [];
                $count = count($games_season);

                foreach($games_season as $key=>$game){

                    if(!isset($array_all_sum[$game->round-1]['put_sum'])){
                        $array_all_sum[$game->round]['put_sum'] = $put_sum;
                    }

                    if($game->result){
                        $array_all_sum[$game->round+1]['put_sum'] = $array_all_sum[$game->round]['put_sum']*$coefficient;
                        $array_all_sum[$game->round]['win_sum'] = 0;
                    }else{
                        $array_all_sum[$game->round+1]['put_sum'] = $put_sum;
                        $array_all_sum[$game->round]['win_sum'] = $array_all_sum[$game->round]['put_sum']*$coefficient_game;
                    }

                    $array_all_sum[$game->round+1]['win_sum'] = 0;
                }

                $array_all_sum = array_slice($array_all_sum, 0, -1, true);

                $array_all_sum['put_sum_all'] = 0;
                $array_all_sum['win_sum_all'] = 0;

                foreach($array_all_sum as $value){
                    $array_all_sum['put_sum_all'] += $value['put_sum'];
                    $array_all_sum['win_sum_all'] += $value['win_sum'];
                }
                
            }

        }


        $round_count = count($games_season);
        $rounds = '';
        if(isset($round_count)){
            for($i=1; $i<=$round_count; $i++){
                $rounds.="'R".$i."',";
            }
            $rounds.="'P/W',";
        }

        $put_sum_all = '';
        $win_sum_all = '';
        foreach($array_all_sum as $key=>$sum){
            if($key != 'put_sum_all' && $key != 'win_sum_all'){
                $put_sum_all.= $sum['put_sum'].',';
                $win_sum_all.= $sum['win_sum'].',';
            }
            elseif($key == 'put_sum_all'){
                $put_sum_all.= $sum.',';
                //$put_sum_all.= $sum['put_sum_all'].',';
            }
            elseif($key == 'win_sum_all'){
                $win_sum_all.= $sum.',';
                //$win_sum_all.= $sum['win_sum_all'].',';
            }
        }

        return $this->render('team', [
            'array_all_sum'=>$array_all_sum,
            'put_sum_all'=>$put_sum_all,
            'win_sum_all'=>$win_sum_all,
            'rounds'=>$rounds,
            'team'=>$team,
        ]);

    }

    public function actionSumUp()
    {
        $country = DrawCountry::find()->where(['id'=>1])->one();
        $league = DrawLeague::find()->where(['name'=>'D1'])->one();
        $season = DrawSeason::find()->where(['slug'=>'201415'])->one();

        $league_season = null;
        if($country && $league && $season){
            $league_season = DrawRelLeagueSeason::find()->where(['league_id'=>$league->id, 'season_id'=>$season->id, 'country_id'=>$country->id])->one();
        }

        if($league_season){

            $rel_team_season = DrawRelTeamSeason::find()->where(['season_league_id'=>$league_season->id])->all();
            $round_count =  DrawGame::find()->where(['season_league_id'=>$league_season->id])->groupBy('round')->count();

            if(!empty($rel_team_season)){

                foreach($rel_team_season as $key=>$team_season){

                    $team = DrawTeam::find()->where(['id'=>$team_season->team_id])->one();
                    $games_team = DrawGame::find()->where(['and',['season_league_id'=>$league_season->id],['or',['team_home_id'=>$team->id],['team_guest_id'=>$team->id]]])->all();

                    if($games_team){

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


                        foreach($games_team as $kk=>$game){


                            /* if($kk<=9 || $kk>=29){
                                 continue;
                             }*/

                            if($game->team_home_goals != $game->team_guest_goals ){
                                $all_pay_sum = $all_pay_sum+$start_sum;
                                //$start_sum = $start_sum*2;

                                if($dr){
                                    $dr=0;
                                    $not_draw = 1;
                                    $start_sum = $start_sum*2;
                                }else{
                                    $not_draw++;
                                    if($not_draw == 10){
                                        $not_draw = 0;
                                        $start_sum = 1;
                                    }else{
                                        $start_sum = $start_sum*2;
                                    }
                                }



                            }else{
                                $dr=1;
                                $win_sum = $win_sum+($start_sum*(4));
                                $all_pay_sum = $all_pay_sum+$start_sum;
                                $start_sum = 1;
                            }

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
                echo "----------------------------------------------------------------------------------------";

                echo "<pre>";
                echo $season->slug.'<br>';
                var_dump($all_pay_sum_all,$win_sum_all);
                echo "</pre>";
                echo "----------------------------------------------------------------------------------------";
            }

        }


    }
}
