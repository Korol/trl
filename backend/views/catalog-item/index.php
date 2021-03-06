<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\CatalogItem;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CatalogItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Catalog Items');
$this->params['breadcrumbs'][] = $this->title;
$catalog = CatalogItem::getCatalogList();
?>
<div class="catalog-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a(Yii::t('app', 'Create Catalog Item'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'sku',
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
//            'image_text',
            // 'favorite',
            // 'num_rows',
            // 'num_seats',
            // 'total_num_seats',
            // 'specification',
            // 'placement',
            // 'comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
