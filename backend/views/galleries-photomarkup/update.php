<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GalleriesPhotomarkup */

$this->title = 'Update Galleries Photomarkup: ' . $model->id_gallery;
$this->params['breadcrumbs'][] = ['label' => 'Galleries Photomarkups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_gallery, 'url' => ['view', 'id' => $model->id_gallery]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="galleries-photomarkup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
