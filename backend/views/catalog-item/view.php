<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CatalogItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalog Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$catalog = $model->catalog;
?>
<div class="catalog-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'catalog_id',
                'value' => $catalog->title,
            ],
            'sku',
            'name',
            [
                'attribute' => 'image',
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data) {
                    $output = '';
                    if (isset($data->image))
                        $output .= Html::img($data->image, ['style' => 'max-width: 150px;']);
                    return $output;
                }
            ],
            'image_text',
            'favorite',
            'num_rows',
            'num_seats',
            'total_num_seats',
            'specification',
            'placement',
            'comment:ntext',
        ],
    ]) ?>

</div>
