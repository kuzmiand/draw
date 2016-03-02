<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Rule */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $model->rule ? $model->rule->slug : 'backend'), 'url' => [$model->rule ? 'backend/index?rule_id='.$model->rule->id : 'index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<section class="content-header">

    <h1><?= Html::encode($this->title) ?></h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><?=  Yii::t('custom' , $model->rule ? $model->rule->slug : 'backend'); ?></li>
    </ol>
</section>


<section class="content">

    <div class="row">

        <section class="col-lg-9 connectedSortable">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'id',
            'status',
            'name',
            'slug',
            ],
            ]) ?>
        </section>

        <section class="col-lg-3 connectedSortable">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?=  Yii::t('custom' , 'Действия');?></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <?=  Html::a('<i class="fa fa-align-left"></i> <span>'. Yii::t('app', 'List'). '</span>', [$model->rule ? 'backend/index/?rule_id='.$model->rule->id : 'index'], ['class' => 'btn btn-block btn-social  btn-primary btn-sm']) ?>
                        <?=  Html::a('<i class="fa fa-plus"></i> <span>'. Yii::t('app', 'Create'). '</span>', [$model->rule ? 'backend/create/?rule_id='.$model->rule->id : 'create'], ['class' => 'btn btn-block btn-social  btn-primary btn-sm']) ?>
                        <?=  Html::a('<i class="fa fa-pencil"></i> <span>'. Yii::t('app', 'Update'). '</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-block btn-social  btn-primary btn-sm']) ?>
                        <?=  Html::a('<i class="fa fa-trash"></i> <span>'.Yii::t('app', 'Delete'). '</span>', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-block btn-social  btn-primary btn-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

</section>




