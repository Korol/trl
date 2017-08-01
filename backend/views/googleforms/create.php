<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Googleforms */

$this->title = 'Create Googleforms';
$this->params['breadcrumbs'][] = ['label' => 'Googleforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="googleforms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
