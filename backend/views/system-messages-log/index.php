<?php

use yii\helpers\Html;

use yii\grid\GridView;

//use kartik\widgets\DynaGrid;
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SystemMessagesLog_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'System Messages Logs ' . date("H:i:s");
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("$(function() {
   $('#popupModal').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
});");

?>
<div class="system-messages-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);

    $a = shell_exec("ps ax | grep -v grep | grep yii");
    echo "<pre>Демоны 1 - быстрый, 2 - медленный:
$a</pre>";?>






    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        'bootstrap' => true,
//        'bordered' => true,
//        'options' => [
//            'align' => 'left',
//        ],
////        'export' => false,
//        'responsive' => true,
//        'striped' => true,
//        'hover' => true,
//        'toggleData' => true,
//        'pjax' => true, // pjax is set to always true for this demo
//        'pjaxSettings' => [
//            'neverTimeout' => true,],
////        'panel' => [
////            'type' => GridView::TYPE_PRIMARY,
////            'heading' => 'Журнал системных событий',
////        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'importance_message',
            /*
             *  выезжающий слайдер  блок - но тут он не нужен - слищкмо большие дампы
             * [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },

                'allowBatchToggle' => true,
//                'detail' => function ($model) {
//                    return Yii::$app->controller->renderPartial('_rows-expand', ['model' => $model]);
//                },
                'detailUrl' => '/system-messages-log/dump-detail',
                'detailOptions' => [
                    'class' => 'kv-state-enable',
                ],

            ],*/

//            'id_message',

            'date_message',
//            'importance_message',

            [
                'attribute' => 'from_message',
                'format' => 'raw',
            ],


            [
                'attribute' => 'subj_message',
                'format' => 'raw',
                'value' => function ($model) {
                    $f_header_start = "";
                    $f_header_stop = "";
                    //0 просто мессадж серым
                    //1 ключевое сообщение зеленым
                    //2 красный варанинг
                    //3 красный ЖИРНЫМ фатал

                    if ($model->importance_message == 0) {
                        $color = "gray";
                    }
                    // писец ошибка
                    if ($model->importance_message == 1) {
                        $color = "green";
                    }
                    if ($model->importance_message == 2) {
                        $color = "red";
                    }
                    if ($model->importance_message == 3) {
                        $color = "red";
                        $f_header_start = "<h2>";
                        $f_header_stop = "</h2>";
                    }

                    return " $f_header_start <font color=$color>" . $model->subj_message . "</font> $f_header_stop ";
                },
//        'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here
//                'filter' => $categoryArr
            ],
//            'body_message:ntext',


            [
                'class' => 'yii\grid\ActionColumn',
//                'controller' => 'admin',
            ],


        ],
    ]);
    ?>

    <!--    --><? //= Html::beginForm(['system-messages-log/bulkdelete'], 'post'); ?>
    <?= Html::a('Удалить ВСЁ', ['bulkdelete'], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы уверены что хотите уничтожить ВСЕ записи?',
            'method' => 'post',
        ],
    ]) ?>
    <!--    --><? //= Html::endForm(); ?>


</div>
