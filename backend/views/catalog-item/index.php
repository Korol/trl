<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\CatalogItem;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CatalogItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalog Items';
$this->params['breadcrumbs'][] = $this->title;
$catalog = CatalogItem::getCatalogList();
?>
<div class="catalog-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Create Catalog Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'catalog_id',
                'format' => 'html',
                'filter' => $catalog,
                'value' => function($data){
                    return $data->catalog->title;
                }
            ],
            'name',
            [
                'attribute' => 'image',
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data) {
                    $output = '';
                    if (!empty($data->image)){
                        $output .= Html::img($data->image, ['style' => 'max-width: 120px;']);
                    }
                    return $output;
                }
            ],
            'sku',
            // 'specification:ntext',
            // 'placement',
            // 'places_num',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
