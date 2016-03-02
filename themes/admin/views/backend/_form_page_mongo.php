<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bupy7\cropbox\Cropbox;

/* @var $this yii\web\View */
/* @var $model app\models\Attribute */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="col-lg-7">

    <?php //$form = ActiveForm::begin(); ?>
    <?php //$form = ActiveForm::begin(['enableClientValidation'=>false, 'enableAjaxValidation' => false,'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'custom_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_2[0]')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_2[1]')->textInput(['maxlength' => true]) ?>

    <?= Html::activeInput( 'text', $model, 'custom_2[3]', [] );?>

    <?// = $form->field($model, 'image')->widget(CropImageUpload::className()) ?>

    <?/*= HTML::input('custom_2', 'tetris') */?>

    <?= $form->field($model, 'image')->widget(Cropbox::className(), [
        'attributeCropInfo' => 'crop_info',
        'optionsCropbox' => [
            'boxWidth' => 600,
            'boxHeight' => 400,
            'cropSettings' => [
                [
                    'width' => 200,
                    'height' => 200,
                ],
            ],
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
