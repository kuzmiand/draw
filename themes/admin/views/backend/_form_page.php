<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

use app\components\yii\Html;
use app\components\yii\ActiveForm;
use bupy7\cropbox\Cropbox;

/* @var $this yii\web\View */
/* @var $model app\models\Attribute */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="col-lg-7">


    <?php $form = ActiveForm::begin(['enableClientValidation'=>false, 'enableAjaxValidation' => false, 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

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


    <h3>CUSTOM ATTRIBUTES</h3><hr>

    <?php if($model->rule->ruleAttributes) { ?>

        <?php foreach($model->rule->ruleAttributes as $attr) { ?>

            <?php if(!$attr->parent) { ?>
                <?= $attr->renderAttribute($model, $form) ?>
            <?php } ?>

        <?php }?>

    <?php } ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
