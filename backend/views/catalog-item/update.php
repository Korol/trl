<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CatalogItem */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Catalog Item',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalog Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="catalog-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
