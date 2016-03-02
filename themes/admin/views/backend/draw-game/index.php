<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Draw Games');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draw-game-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Draw Game'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'team_home_id',
            'team_guest_id',
            'team_home_first_half_goals',
            'team_guest_first_half_goals',
            // 'team_home_second_half_goals',
            // 'team_guest_second_half_goals',
            // 'team_home_goals',
            // 'team_guest_goals',
            // 'result_firs_half',
            // 'result_second_half',
            // 'result_amount',
            // 'result',
            // 'season_id',
            // 'league_id',
            // 'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
