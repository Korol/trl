<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SystemMessagesLog */

$this->title = 'Update System Messages Log: ' . ' ' . $model->id_message;
$this->params['breadcrumbs'][] = ['label' => 'System Messages Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_message, 'url' => ['view', 'id' => $model->id_message]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="system-messages-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
