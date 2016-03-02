<?php

use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('app', $model->rule ? $model->rule->slug : 'backend');
$this->params['breadcrumbs'][] = $this->title;
?>



<section class="content-header">

    <h1><?= Yii::t('app', 'backend index') ?></h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li><
    </ol>

</section>


<section class="content">

    <div class="row">

        <section class="col-lg-9 connectedSortable">

        </section>

        <section class="col-lg-3 connectedSortable">

        </section>
    </div>



</section>

