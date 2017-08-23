<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CatalogItemOld2;

/* @var $this yii\web\View */
/* @var $model backend\models\CatalogItemOld2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(CatalogItemOld2::getCatalogList()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specification')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'placement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'places_num')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
