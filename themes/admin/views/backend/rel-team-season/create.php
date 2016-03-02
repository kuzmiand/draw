<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DrawRelTeamSeason */

$this->title = Yii::t('app', 'Create Draw Rel Team Season');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Rel Team Seasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draw-rel-team-season-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
