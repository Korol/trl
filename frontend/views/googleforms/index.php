<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GoogleformsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Googleforms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="googleforms-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Googleforms', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',

            [
                'attribute' => 'google_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->google_id . '<br>'
                    . $model->google_id_editmode . '<br>';
                },
            ],


            'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
