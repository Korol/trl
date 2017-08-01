<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?php //= $form->field($model, 'type')->textInput(['maxlength' => 255]) ?>


    <?= $form->field($model, 'key')->textInput(['maxlength' => 255, $model->isNewRecord ? '' : 'disabled'=>'true']) ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <?php //= $form->field($model, 'active')->textInput() ?>

    <?php //= $form->field($model, 'created')->textInput() ?>

    <?php //= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'section')->textInput(['maxlength' => 255, $model->isNewRecord ? '' : 'disabled'=>'true']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
