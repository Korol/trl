<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = '' . $model->section. '.' . $model->key;

$this->params['breadcrumbs'][] = ['label' => 'Параметри', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->section. '.' . $model->key, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
