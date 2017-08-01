<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = $var_name;
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 300px;
        margin: 0px 20px 70px 20px;
        display: list-item;
        border: 2px solid #fff;
    }
    .red-border {
        border: 2px solid red;
    }
    #layer-img {
        width: 650px;
        height: 650px;
    }
    #container{
        position: relative;
    }
    #layer0, #layer1, #layer2{
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
                <div id="layer2" class="layer"></div>
                <div id="layer3" class="layer"></div>

                <div class="fotorama" id="mfotorama"
                    data-width="650"
                    data-height="650"
                    data-direction="ltr"
                    data-nav="thumbs">
                    <img src="/_altar/1/alt_freize_rez/alt_freize_rez1_<?=$type?>_<?=$color?>.png"  data-caption="freize 1" class="img-view">
                    <img src="/_altar/1/alt_freize_rez/alt_freize_rez2_<?=$type?>_<?=$color?>.png"  data-caption="freize 2" class="img-view">
                    <img src="/_altar/1/alt_freize_rez/alt_freize_rez3_<?=$type?>_<?=$color?>.png"  data-caption="freize 3" class="img-view">
                   <!--<img src="/_altar/1/alt_door/alt_door2_1_1.png"  data-caption="door 1" class="img-view">-->
                   <!--<img src="/_altar/1/alt_door/alt_door2_2_1.png"  data-caption="door 1" class="img-view">-->
               </div>
            </div>
        </div>

        <div class="col-lg-4">

            <a href="#" onclick="setImg(1);return false;"><img src="/_altar/1/alt_freize_che/frieze_che1.png" class="img-view red-border" id="img1"></a>
            <a href="#" onclick="setImg(2);return false;"><img src="/_altar/1/alt_freize_che/frieze_che1.png" class="img-view" id="img2"></a>

            <form method="POST">
                <input type="hidden" name="<?=$var_name?>" value="" id="<?=$var_name?>">
                <input type="hidden" name="freize_che" value="1" id="freize_che">
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default" style="margin-left: 130px;">
            </form>
        </div>

        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>

    $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');
    $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice'+<?=$cornice?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
    $('#layer2').html('<img src="/_altar/1/alt_door/alt_door'+<?=$door?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');

    $('#mfotorama').on('fotorama:show', function (e, fotorama) {
        $('#<?=$var_name?>').val((fotorama.activeIndex + 1));
    });

    function setImg( num ) {
        $('#freize_che').val(num);
        if ( num == 1 ) {
            $('#img1').addClass('red-border');
            $('#img2').removeClass('red-border');
        } else {
            $('#img2').addClass('red-border');
            $('#img1').removeClass('red-border');
        }
    }
</script>
