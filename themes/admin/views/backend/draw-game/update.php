<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DrawGame */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Draw Game',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Games'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="draw-game-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
