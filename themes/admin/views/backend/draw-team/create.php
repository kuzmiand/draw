<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DrawTeam */

$this->title = Yii::t('app', 'Create Draw Team');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Teams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draw-team-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
