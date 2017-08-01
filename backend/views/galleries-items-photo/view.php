<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GalleriesItemsPhoto */

$this->title = $model->id_item;
$this->params['breadcrumbs'][] = ['label' => 'Galleries Items Photos', ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galleries-items-photo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_item], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_item], [
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
//            'id_item',
            'gallery_id',
            'name_item',
//            'file_id',
        ],
    ]) ?>

</div>
