<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogItem */

$this->title = $model->title;
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
        <?= Html::a(Yii::t('app', 'Create Catalog Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'catalog_id',
                'value' => $catalog->title,
            ],
            [
                'attribute' => 'files',
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data) {
                    $output = '';
                    if (isset($data->files[0]))
                        $output .= Html::img($data->files[0]->url, ['style' => 'max-width: 150px;']);
                    return $output;
                }
            ],
            'title',
            'description:ntext',
            [
                'attribute' => 'active',
                'value' => function($data){
                    return ($data->active > 0) ? 'Yes' : 'No';
                }
            ],
        ],
    ]);
    ?>


</div>
