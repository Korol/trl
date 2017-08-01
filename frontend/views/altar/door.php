<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = 'דלתות';
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 650px;
        height: 650px;
    }
    #layer-img {
        width: 650px;
        height: 650px;
    }
    #container{
        position: relative;
    }
    #layer0, #layer1{
        position: absolute;
    }
</style>

<?php
    $originType = $type;
    if ( $type == 1 || $type == 2) {
        $type = 1;
    } else {
        $type = 2;
    }
?>

<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-8">
            <div id="container">
                <div id="layer0" class="layer generalBG"></div>

                <div id="layer1" class="layer"></div>

                <div class="fotorama" id="mfotorama"
                    data-width="650"
                    data-height="650"
                    data-direction="rtl"
                    data-nav="thumbs">
                    <img src="/_altar/1/alt_door/alt_door2_<?=$type?>_<?=$color?>.png"  data-caption="דלתות עם סרגלי קישוט" class="img-view">
                    <img src="/_altar/1/alt_door/alt_door3_<?=$type?>_<?=$color?>.png"  data-caption="דלתות חלקות" class="img-view">
               </div>
            </div>
        </div>

        <div class="col-lg-4" style="height: 650px;">
            <form method="POST" style="position: absolute;bottom: 0;">
                <input type="hidden" name="<?=$var_name?>" value="" id="<?=$var_name?>">

                <a href="/altar/cornice"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default">
            </form>
        </div>

        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>
    $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');

    <? if ($cornice == 2) : ?>
        $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice'+<?=$cornice?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
    <? endif; ?>

    $('#mfotorama').on('fotorama:show', function (e, fotorama) {
        $('#<?=$var_name?>').val((fotorama.activeIndex + 1));
    });
</script>
