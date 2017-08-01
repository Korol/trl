<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SystemMessagesLog */

$this->title = 'Create System Messages Log';
$this->params['breadcrumbs'][] = ['label' => 'System Messages Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-messages-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
