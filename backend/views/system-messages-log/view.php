<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemMessagesLog */

$this->title = $model->id_message;
$this->params['breadcrumbs'][] = ['label' => 'System Messages Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-messages-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_message], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_message], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_message',
            'date_message',
            'importance_message',
            'from_message',
            'subj_message',
            'body_message:ntext',
        ],
    ]) ?>

</div>
