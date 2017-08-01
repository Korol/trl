<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SystemMessagesLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-messages-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_message')->textInput() ?>

    <?= $form->field($model, 'date_message')->textInput() ?>

    <?= $form->field($model, 'importance_message')->textInput() ?>

    <?= $form->field($model, 'from_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_message')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
