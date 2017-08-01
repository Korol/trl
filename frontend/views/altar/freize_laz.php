<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = $var_name;
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 300px;
        margin: 0px 20px 20px 20px;
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
    .container1{
        position: relative;
        height: 650px;
    }
    #layer0, #layer1, #layer2, #layer3{
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
            <div id="container" class="container1">
                <div id="layer0" class="layer generalBG"></div>
                <div id="layer1" class="layer"></div>
                <div id="layer2" class="layer"></div>
                <div id="layer3" class="layer"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <a href="#" onclick="setImg(1);return false;"><img src="/_altar/1/alt_freize_laz/frieze_laz1.png" class="img-view red-border" id="img1"></a>
            <a href="#" onclick="setImg(2);return false;"><img src="/_altar/1/alt_freize_laz/frieze_laz2.png" class="img-view" id="img2"></a>
            <a href="#" onclick="setImg(3);return false;"><img src="/_altar/1/alt_freize_laz/frieze_laz3.png" class="img-view" id="img3"></a>

            <form method="POST">
                <input type="hidden" name="<?=$var_name?>" value="" id="<?=$var_name?>">
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default" style="margin-left: 130px;">
            </form>
        </div>
        <div style="clear: both;"></div>
	</div>
</div>

<script>

    $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');
    $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice'+<?=$cornice?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
    $('#layer2').html('<img src="/_altar/1/alt_door/alt_door'+<?=$door?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
    $('#layer3').html('<img src="/_altar/1/alt_freize_rez/alt_freize_rez'+<?=$freize_rez?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');

    function setImg( num ) {
        $('#<?=$var_name?>').val(num);
        $('.img-view').removeClass('red-border');
        $('#img'+num).addClass('red-border');
    }
</script>
