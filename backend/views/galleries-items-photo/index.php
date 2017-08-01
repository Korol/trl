<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GalleriesItemsPhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galleries Items Photos';
$this->params['breadcrumbs'][] = $this->title;
if (!isset($_GET['GalleriesItemsPhotoSearch']['gallery_id'])) $_GET['GalleriesItemsPhotoSearch']['gallery_id']=0
?>
<div class="galleries-items-photo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Galleries Items Photo', ['create?id=' . $_GET['GalleriesItemsPhotoSearch']['gallery_id']], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_item',
//            'gallery_id',


            [
                'label' => 'Photo',
                'format' => 'raw',

                'value' => function ($model) {
                    // Костыль для модуля аплоуда - в базе по другому поле  наывается
                    $model->id = $model->id_item;

                    if (isset($model->files[0]))
                        return
                            '<a href="/galleries-items-photo/update?id='.$model->id_item.'"><img border=1 width=100 src="/attachments/file/download?id=' . $model->files[0]->id . '"></a>';
                    else return null;
                },
                'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here


            ],


            [
                'attribute' => 'name_item',
                'format' => 'raw',
                'value' => function ($model) {

                        return
                            '<a href="/galleries-items-photo/update?id='.$model->id_item.'">' . $model->name_item . '</a>';
                },
                'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here


            ],


//            'file_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
