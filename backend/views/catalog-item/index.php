<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\CatalogItem;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Catalog Items');
$this->params['breadcrumbs'][] = $this->title;
$catalog = CatalogItem::getCatalogList();
?>
<div class="catalog-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Catalog Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'files',
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data) {
                    $output = '';
                    if (isset($data->files[0])){
                        $output .= Html::img($data->files[0]->url, ['style' => 'max-width: 120px;']);
                    }
                    return $output;
                }
            ],
            [
                'attribute' => 'catalog_id',
                'format' => 'html',
                'filter' => $catalog,
                'value' => function($data){
                    return $data->catalog->title;
                }
            ],
            'title',
            'description:ntext',
            [
                'attribute' => 'active',
                'filter' => [0 => 'No', 1 => 'Yes'],
                'format' => 'html',
                'value' => function($data){
                    return ($data->active > 0) ? 'Yes' : 'No';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script>
    jQuery(document).ready(function ($) {
        $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
    });

</script>