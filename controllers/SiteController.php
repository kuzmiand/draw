<?php

namespace app\controllers;

use app\models\DrawCountry;
use app\models\DrawGame;
use app\models\DrawLeague;
use app\models\DrawRelLeagueSeason;
use app\models\DrawRelTeamSeason;
use app\models\DrawSeason;
use app\models\DrawTeam;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use keltstr\simplehtmldom\SimpleHTMLDom as SHD;

class SiteController extends Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        echo "<pre>";
        var_dump(strtotime('22.03.2007'));
        die();
        echo "</pre>";
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionParsLeague(){

        $b_array = [10, 20, 30, 40];
        $c = 51;
        $d_array = [201415, 201314, 201213, 201112, 201011];
        //$d_array = [201314];

        foreach($d_array as $d){

            $season = DrawSeason::find()->where(['slug'=>$d])->one();
            $lg = DrawLeague::find()->where(['name'=>'D1'])->one();

            if($season && $lg){

                $html_source = SHD::file_get_html('http://www.stat-football.com/en/a/eng.php?b=10&d='.$d.'&c=51');
                $results =  $html_source->find('tr[class=im0]');

                if($results){
                    foreach($results as $key=>$result){
                        if($result && $result->children){

                            $children = $result->children;

                            $game = new DrawGame();

                            $game->round = $children[0]->innertext;
                            $game->date = strtotime($children[1]->innertext);

                            $team_1 = 0;
                            if($children[2]->innertext){
                                $team_1 = DrawTeam::find()->where(['name'=>$children[2]->innertext])->one();
                                if(!$team_1){
                                    $team_1 = new DrawTeam();
                                    $team_1->name = $children[2]->innertext;
                                    $team_1->slug = preg_replace('/[\s.]/', '_', strtolower($children[2]->innertext));
                                    $team_1->country_id = 1;
                                    $team_1->save();
                                }
                            }

                            $team_2 = 0;
                            if($children[3]->innertext){
                                $team_2 = DrawTeam::find()->where(['name'=>$children[3]->innertext])->one();
                                if(!$team_2){
                                    $team_2 = new DrawTeam();
                                    $team_2->name = $children[3]->innertext;
                                    $team_2->slug = preg_replace('/[\s.]/', '_', strtolower($children[3]->innertext));
                                    $team_2->country_id = 1;
                                    $team_2->save();
                                }
                            }

                            $game->team_home_id = $team_1 ? $team_1->id : 0;
                            $game->team_guest_id = $team_2 ? $team_2->id : 0;

                            $around = strip_tags($children[4]);

                            $amount_full = trim(strstr($around, "(", true));
                            $amount_full_explode = explode(':', $amount_full);

                            $amount_partial = strstr($around, "(");
                            $amount_partial = str_replace('(', '', $amount_partial);
                            $amount_partial = str_replace(')', '', $amount_partial);
                            $amount_partial = explode(',', $amount_partial);

                            $amount_partial_1 = explode(':', $amount_partial[0]);
                            $amount_partial_2 = explode(':', $amount_partial[1]);

                            $game->team_home_first_half_goals = $amount_partial_1[0];
                            $game->team_guest_first_half_goals = $amount_partial_1[1];
                            $game->team_home_second_half_goals = $amount_partial_2[0];
                            $game->team_guest_second_half_goals = $amount_partial_2[1];
                            $game->team_home_goals = $amount_full_explode[0];
                            $game->team_guest_goals = $amount_full_explode[1];

                            $game->result_firs_half = $amount_partial[0];
                            $game->result_second_half = $amount_partial[1];
                            $game->result_amount = $amount_full;

                            $game->result = ($amount_full_explode[0] == $amount_full_explode[1]) ? 0 : 1;


                            $league_season = DrawRelLeagueSeason::find()->where(['league_id'=>$lg->id, 'season_id'=>$season->id, 'country_id'=>1])->one();
                            if(!$league_season){
                                $league_season = new DrawRelLeagueSeason();
                                $league_season->league_id = $lg->id;
                                $league_season->season_id = $season->id;
                                $league_season->country_id = 1;
                                $league_season->name_league = 'Premier League';
                                $league_season->save();
                            }

                            $team_1_season = DrawRelTeamSeason::find()->where(['season_league_id'=>$league_season->id, 'team_id'=>$team_2->id])->one();
                            if(!$team_1_season){
                                $team_1_season = new DrawRelTeamSeason();
                                $team_1_season->season_league_id = $league_season->id;
                                $team_1_season->team_id = $team_1->id;
                                $team_1_season->save();
                            }
                            $team_2_season = DrawRelTeamSeason::find()->where(['season_league_id'=>$league_season->id, 'team_id'=>$team_2->id])->one();
                            if(!$team_2_season){
                                $team_2_season = new DrawRelTeamSeason();
                                $team_2_season->season_league_id = $league_season->id;
                                $team_2_season->team_id = $team_2->id;
                                $team_2_season->save();
                            }

                            $game->season_league_id = $league_season->id;
                            $game->save();

                            echo "<pre>";
                            var_dump($game->round, $game->team_home_id, $game->team_guest_id, $game->result_amount);
                            echo "</pre>";

                            unset($team_1);
                            unset($team_2);
                            unset($team_1_season);
                            unset($team_2_season);
                            unset($game);
                        }

                    }
                }
            }
        }

    }

    public function actionSeasons(){

        for($i=1888; $i<=2016; $i++){
            $season = new DrawSeason();
            $next = $i+1;
            $season->name = $i.'-'.$next;
            $season->start = $i;
            $season->end = $next;
            $season->slug = $i.substr($next, -2);
            $season->save();
            echo "<pre>";
            var_dump($season->slug);
            echo "</pre>";
        }

        $d_array = ['D1', 'D2', 'D3', 'D4'];
        foreach($d_array as $d){
            $d_new = new DrawLeague();
            $d_new->name = $d;
            $d_new->slug = strtolower($d);
            $d_new->save();
            echo "<pre>";
            var_dump($d_new->slug);
            echo "</pre>";
        }

    }


    public function actionStatDraw(){

        $country = DrawCountry::find()->where(['id'=>1])->one();
        $league = DrawLeague::find()->where(['name'=>'D1'])->one();

        $seasons = DrawSeason::find()->where(['or', ['slug'=> [201415, 201314, 201213, 201112, 201011]]])->all();

        foreach($seasons as $season){
            $league_season = null;
            if($country && $league && $season){
                $league_season = DrawRelLeagueSeason::find()->where(['league_id'=>$league->id, 'season_id'=>$season->id, 'country_id'=>$country->id])->one();
            }

            if($league_season){
                $rel_team_season = DrawRelTeamSeason::find()->where(['season_league_id'=>$league_season->id])->all();
                if(!empty($rel_team_season)){
                    $win_sum_all = 0;
                    $all_pay_sum_all = 0;
                    foreach($rel_team_season as $key=>$team_season){
                        $team = DrawTeam::find()->where(['id'=>$team_season->team_id])->one();
                        $games_team = DrawGame::find()->where(['and',['season_league_id'=>$league_season->id],['or',['team_home_id'=>$team->id],['team_guest_id'=>$team->id]]])->all();

                        if($games_team){
                            $start_sum = 1;
                            $win_sum = 0;
                            $all_pay_sum = 0;

                            $not_draw =0;
                            $dr = 0;
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

}
