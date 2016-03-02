<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Attribute */

$this->title = Yii::t('app', 'Create Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="content-header">
    <h1>
        <?= Yii::t('custom' , 'Create Page'); ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><?= Yii::t('custom' , 'Create Page'); ?></li>
    </ol>
</section>


<section class="content">

    <div class="row">

        <section class="col-lg-9 connectedSortable">
            <?= $this->render('_form_page_mongo', [
                'model' => $model,
            ]) ?>
        </section>

        <section class="col-lg-3 connectedSortable">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= Yii::t('custom' , 'Действия');?></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <?=  Html::a('<i class="fa fa-align-left"></i> <span>'. Yii::t('app', 'List'). '</span>', [$model->rule ? 'backend/index/?rule_id='.$model->rule->id : 'index'], ['class' => 'btn btn-block btn-social  btn-primary btn-sm']) ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

</section>