<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GalleriesPhotomarkupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galleries Photomarkups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galleries-photomarkup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Galleries Photomarkup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_gallery',
//            'name_gallery',


            [
                'attribute' => 'name_gallery',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a href="/galleries-items-photo?GalleriesItemsPhotoSearch%5Bgallery_id%5D=' . $model->id_gallery . '">' . $model->name_gallery . '</a>';
                },
//                //                'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here
//                'filter' => \yii\helpers\ArrayHelper::map(
//                    \app\models\ProjectDomainlevel::find()
//                        ->andWhere(['sape_account_id' => Yii::$app->user->identity->id])
//                        ->select('id_pdl, name_pdl')->all(),
//                    'id_pdl',
//                    'name_pdl'
//                ),

            ],


            'commwnt_gallery',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
