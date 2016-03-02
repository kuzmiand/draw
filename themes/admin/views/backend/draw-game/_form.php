<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DrawGame */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="draw-game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'team_home_id')->textInput() ?>

    <?= $form->field($model, 'team_guest_id')->textInput() ?>

    <?= $form->field($model, 'team_home_first_half_goals')->textInput() ?>

    <?= $form->field($model, 'team_guest_first_half_goals')->textInput() ?>

    <?= $form->field($model, 'team_home_second_half_goals')->textInput() ?>

    <?= $form->field($model, 'team_guest_second_half_goals')->textInput() ?>

    <?= $form->field($model, 'team_home_goals')->textInput() ?>

    <?= $form->field($model, 'team_guest_goals')->textInput() ?>

    <?= $form->field($model, 'result_firs_half')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result_second_half')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result')->textInput() ?>

    <?= $form->field($model, 'season_id')->textInput() ?>

    <?= $form->field($model, 'league_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
