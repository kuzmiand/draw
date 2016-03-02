<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DrawLeague */

$this->title = Yii::t('app', 'Create Draw League');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Leagues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draw-league-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'countries'=>$countries
    ]) ?>

</div>
