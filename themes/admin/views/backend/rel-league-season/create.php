<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DrawRelLeagueSeason */

$this->title = Yii::t('app', 'Create Draw Rel League Season');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Rel League Seasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draw-rel-league-season-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
