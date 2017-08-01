<?php


//$this->registerJsFile('path/to/myfile');
//$this->registerCssFile('path/to/myfile');


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

$this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

$this->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);
$this->title = 'קרניז';
$this->params['breadcrumbs'][] = $this->title;

/**
 * Джава скрипт сам определяет номер мебели по ГЕТ запросу
 * и формирует Ajax запорс вида http://lavi.new-dating.com/site/furniture-ajax?id=1&action=get_colors
 * где подтягивает соотсветсвующие детали стула с нужным номером
 */

?>
<style>
    .img-select {
        border: 3px solid #ff0000;
    }
    .img-view {
        width: 300px;
        margin: 50px 20px 50px 75px;
        display: list-item;
        /*border: 2px solid #fff;*/
    }
    #layer-img {
        width: 650px;
        height: 650px;
    }
    #layer0, #layer1, #layer2, #layer3, #layer4{
        position: absolute;
    }
</style>
<div class="site-signup">
    <h1  class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>


    <div class="row">
        <div class="col-lg-6" >
            <div id="container">
                <div id="layer0" class="layer generalBG"></div>
                <div id="layer1" class="layer"></div>
                <div id="layer3" class="layer"></div>
                <div id="layer2" class="layer"></div>
                <div id="layer4" class="layer"></div>
                <div id="layer5" class="layer"></div>
                <div id="layer6" class="layer"></div>
                <div id="layer7" class="layer"></div>
                <!--                        <div id="generalBG"><img src="" alt=""/></div>-->
            </div>
        </div>

        <div class="col-lg-1">
        </div>

        <div class="col-lg-4">
            <form method="POST">
                <input type="hidden" name="imgnuminlist_cornice" id="imgnuminlist_cornice" value="1">
                <div style="width:100%;position: relative;" class="div-class" id="div1" value="1" data-n="1">
                    <span style="position: absolute; top: 20px;">קרניז מוגבה ק1</span>
                    <img src="/_cabinet/preview_cornice/cornice1.png" class="img-view <?=$type==1?' img-select':''?>" id="img1">
                    <input type="radio" name="cornice" <?=$type==1?' checked="checked"':''?> value="1" style="position: absolute; top: 35px;left: 350px;" data-n="1">
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div2" value="4" data-n="2">
                    <span style="position: absolute; top: 20px;">קרניז מפותח ק4.1</span>
                    <img src="/_cabinet/preview_cornice/cornice4.png" class="img-view <?=$type==4?' img-select':''?>" id="img4" >
                    <input type="radio" name="cornice" <?=$type==4?' checked="checked"':''?> value="4" style="position: absolute; top: 35px;left: 350px;" data-n="2">
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div3" value="5" data-n="3">
                    <span style="position: absolute; top: 20px;">קרניז ישר ק5</span>
                    <img src="/_cabinet/preview_cornice/cornice5.png" class="img-view <?=$type==5?' img-select':''?>" id="img5">
                    <input type="radio" name="cornice" <?=$type==5?' checked="checked"':''?> value="5" style="position: absolute; top: 35px;left: 350px;" data-n="3">
                </div>

                <a href="/cabinet/count-0-0-2"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px; margin-left: 80px;" ></a>
                <input type="submit" name="submit" value="<?=Yii::t('common', 'Next step')?>" class="btn btn-style-default" >
            </form>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <br>&nbsp;
                <br>&nbsp;
                <br>&nbsp;
                <br>&nbsp;

            </div>
        </div>

    </div>
</div>

<script>

    // Положим на первый слой картинку с фоном
    $(document).ready(function()
    {
        $('#layer1').html('<img src="/_cabinet/<?=$num?>/bookcase/bookcase<?=$typecabinet?>_<?=$num?>_<?=$color?>.png" id="layer-img">');
        $('#layer2').html('<img src="/_cabinet/<?=$num?>/cornice/cornice<?=$type?>_<?=$num?>_<?=$color?>.png" id="layer-img">');
    });



    // Функция для выбора картинки
    $('input[name="cornice"]').change(function(){
        $('#imgnuminlist_cornice').val($(this).attr('data-n'));
        var num = this.value;
        sel(num);
    });

    $('.div-class').click(function(){
        $('#imgnuminlist_cornice').val($(this).attr('data-n'));
        var num = $(this).attr('value');
        sel(num);
    });

    function sel( num ) {
        $('#layer2').html('<img src="/_cabinet/<?=$num?>/cornice/cornice'+num+'_<?=$num?>_<?=$color?>.png" id="layer-img">');
        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');
    }

</script>
