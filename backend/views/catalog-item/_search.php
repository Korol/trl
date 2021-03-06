<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CatalogItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'image_text') ?>

    <?php // echo $form->field($model, 'favorite') ?>

    <?php // echo $form->field($model, 'num_rows') ?>

    <?php // echo $form->field($model, 'num_seats') ?>

    <?php // echo $form->field($model, 'total_num_seats') ?>

    <?php // echo $form->field($model, 'specification') ?>

    <?php // echo $form->field($model, 'placement') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
