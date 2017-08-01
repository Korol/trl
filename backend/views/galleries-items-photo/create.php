<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GalleriesItemsPhoto */

$this->title = 'Create Galleries Items Photo';
$this->params['breadcrumbs'][] = ['label' => 'Galleries Items Photos'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galleries-items-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gallery' => $gallery,
    ]) ?>

</div>
