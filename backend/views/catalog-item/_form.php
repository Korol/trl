<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CatalogItem;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogItem */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .krajee-default .file-preview-image {
        max-width: 150px;
    }
    .file-zoom-content .file-preview-image {
        max-width: 75%;
        max-height: 75%;
    }
</style>
<div class="catalog-item-form">

    <?php $form = ActiveForm::begin(
            [
                'options' => ['enctype' => 'multipart/form-data'],
            ]
    ); ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(CatalogItem::getCatalogList()) ?>

    <?php
//    if(!$model->isNewRecord && !empty($model->files)){
//        echo \nemmo\attachments\components\AttachmentsTable::widget(['model' => $model]);
//    }
    ?>

    <?= \nemmo\attachments\components\AttachmentsInput::widget([
        'id' => 'file-input', // Optional
        'model' => $model,
        'options' => [ // Options of the Kartik's FileInput widget
            'multiple' => false, // If you want to allow multiple upload, default to false
        ],
        'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget
            'maxFileCount' => 1 // Client max files
        ]
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?php
    if($model->isNewRecord) $model->active = 1;
    ?>
    <?= $form->field($model, 'active')->dropDownList([0 => 'No', 1 => 'Yes']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
