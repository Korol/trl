<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SystemMessagesLog_Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-messages-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_message') ?>

    <?= $form->field($model, 'date_message') ?>

    <?= $form->field($model, 'importance_message') ?>

    <?= $form->field($model, 'from_message') ?>

    <?= $form->field($model, 'subj_message') ?>

    <?php // echo $form->field($model, 'body_message') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
