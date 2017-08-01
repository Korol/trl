<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GalleriesItemsPhoto */

$this->title = 'Update Galleries Items Photo: ' . $model->name_item;
$this->params['breadcrumbs'][] = ['label' => 'Galleries Items Photos', ];
$this->params['breadcrumbs'][] = ['label' => $model->id_item, 'url' => ['view', 'id' => $model->id_item]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="galleries-items-photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gallery' => $gallery,

    ]) ?>

</div>
