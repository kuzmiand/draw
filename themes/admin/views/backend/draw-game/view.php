<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DrawGame */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Games'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draw-game-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'team_home_id',
            'team_guest_id',
            'team_home_first_half_goals',
            'team_guest_first_half_goals',
            'team_home_second_half_goals',
            'team_guest_second_half_goals',
            'team_home_goals',
            'team_guest_goals',
            'result_firs_half',
            'result_second_half',
            'result_amount',
            'result',
            'season_id',
            'league_id',
            'date',
        ],
    ]) ?>

</div>
