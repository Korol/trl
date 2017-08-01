<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GalleriesPhotomarkup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galleries-photomarkup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_gallery')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commwnt_gallery')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
