<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CatalogItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Catalog Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$catalog = $model->catalog;
?>
<div class="catalog-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'sku',
            [
                'attribute' => 'catalog_id',
                'value' => $catalog->title,
            ],
            [
                'attribute' => 'filimagees',
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data) {
                    $output = '';
                    if (isset($data->image))
                        $output .= Html::img($data->image, ['style' => 'max-width: 150px;']);
                    return $output;
                }
            ],
            'specification:ntext',
            'placement',
            'places_num',
        ],
    ]) ?>

</div>
