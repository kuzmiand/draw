<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DrawSeason */

$this->title = Yii::t('app', 'Create Draw Season');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Seasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draw-season-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
