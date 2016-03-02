<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DrawRelTeamSeason */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Draw Rel Team Season',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Rel Team Seasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="draw-rel-team-season-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
