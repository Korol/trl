<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GalleriesPhotomarkup */

$this->title = 'Create Galleries Photomarkup';
$this->params['breadcrumbs'][] = ['label' => 'Galleries Photomarkups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galleries-photomarkup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
