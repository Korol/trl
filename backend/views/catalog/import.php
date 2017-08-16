<?php
/**
 * @var $catalog_list
 */

use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Catalog Import');
$this->params['breadcrumbs'][] = $this->title;
$uploadError = \Yii::$app->session->getFlash('uploadError', '');
$importError = \Yii::$app->session->getFlash('importError', '');
$uploadSuccess = \Yii::$app->session->getFlash('uploadSuccess', '');
$importSuccess = \Yii::$app->session->getFlash('importSuccess', '');
$success = (!empty($uploadSuccess) || !empty($importSuccess));
$error = (!empty($uploadError) || !empty($importError));
?>

<?php if($success): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $uploadSuccess; ?> <?= $importSuccess; ?>
    </div>
<?php endif; ?>

<?php if($error): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $uploadError; ?> <?= $importError; ?>
    </div>
<?php endif; ?>

<?php $form = ActiveForm::begin(['action' => '/catalog/import-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'catalog_id')->dropDownList($catalog_list); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'importfile')->fileInput(); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <button type="submit" class="btn btn-success">Import</button>
    </div>
</div>
<?php ActiveForm::end(); ?>