<?php


//$this->registerJsFile('path/to/myfile');
//$this->registerCssFile('path/to/myfile');


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'מיקום';
$this->params['breadcrumbs'][] = $this->title;

/**
 * Джава скрипт сам определяет номер мебели по ГЕТ запросу
 * и формирует Ajax запорс вида http://lavi.new-dating.com/site/furniture-ajax?id=1&action=get_colors
 * где подтягивает соотсветсвующие детали стула с нужным номером
 */

$this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

$this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);
?>
<style>
    .img-view {
        width: 650px;
        height: 650px;
    }
    .btn-style-default
    {
        font-size: 14px !important;
    }
</style>
<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-8">
            <div class="fotorama" id="mfotorama"
                 data-width="650"
                 data-height="650"
                 data-direction="rtl"
                 data-nav="thumbs">
                <img src="/_cabinet/cube_placement/1c.png" data-caption="צמוד לקיר ימין"  class="img-view">
                <img src="/_cabinet/cube_placement/2c.png" data-caption="צמוד לקיר שמאל" class="img-view">
                <img src="/_cabinet/cube_placement/3c.png" data-caption="בנישה" class="img-view">
                <img src="/_cabinet/cube_placement/4c.png" data-caption="ללא הצמדה" class="img-view">
            </div>
        </div>

        <div class="col-lg-4" style="height: 650px;">
            <form method="POST" style="position: absolute;bottom: 0;">
                <input type="hidden" name="placement" value="" id="type">
                <a href="/cabinet/type"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
                <input type="submit" name="submit" value="<?=Yii::t('common', 'Next step')?>" class="btn btn-style-default">
            </form>
        </div>

        <!--<div class="ws_shadow"></div>-->
    </div>

</div>
<script>
    $('#mfotorama').on('fotorama:show', function (e, fotorama) {
        $('#type').val((fotorama.activeIndex + 1));
    });
</script>
