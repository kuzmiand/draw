<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DrawGame */

$this->title = Yii::t('app', 'Create Draw Game');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Draw Games'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draw-game-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
