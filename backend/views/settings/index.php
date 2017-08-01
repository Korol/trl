<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Settings;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Параметри';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <?= Html::a('Новий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            
 
            //'type',


                [
                    'attribute' => 'section',
                    'filter' => ArrayHelper::map(
                        Settings::find()->select('section')->distinct()->where('section <> ""')->all(),
                        'section',
                        'section'
                    ),
                ],

            [
                'attribute' => 'key',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->key, ['update', 'id' => $model->id]);
                },
            ],

            [
                'attribute' => 'value',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->value, ['update', 'id' => $model->id]);
                },
            ],


          
  'desc:ntext',
          
            // 'value:ntext',
            // 'active',
            // 'created',
            // 'modified',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
Внимание администратора! Модуль оснащен кэшированием - не рекомендуется делать измнения в БД в обход интерфейса. 
