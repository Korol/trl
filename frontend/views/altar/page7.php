<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title =  'בחירת לבד מעכב בעירה לחיפוי פנים';//Yii::t('common', 'Altar') . ' - '.
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 150px;
        margin: 0px 20px 20px 20px;
        display: list-item;
        /*border: 2px solid #fff;*/
    }
    .img-select {
        border: 3px solid #ff0000;
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

        <div class="col-lg-8" style="text-align: center;">
            <div id="container" class="container1" style="display: none">
                <div id="layer0" class="layer generalBG"></div>
                <div id="layer1" class="layer"></div>
                <div id="layer2" class="layer"></div>
                <div id="layer3" class="layer"></div>
            </div>
            <img src="/_altar/1/page_7.png" id="layer-img" style="height: auto">
        </div>

        <div class="col-lg-4">
            <form method="POST">
                <div style="width:100%;position: relative;" class="div-class" id="div1" value="1">
                    <img src="/_altar/1/alt_color/b_0.png" class="img-view img-select" id="img1">
                    <input type="radio" name="<?=$var_name?>" checked="checked" value="1" style="position: absolute; top: 65px;left: 250px;">
                    <p style="position: absolute; top: 65px;left: 90px;">1</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div2" value="2">
                    <img src="/_altar/1/alt_page7/red.png" class="img-view" id="img2">
                    <input type="radio" name="<?=$var_name?>" value="2" style="position: absolute; top: 65px;left: 250px;">
                    <p style="position: absolute; top: 65px;left: 90px;">2</p>
                </div>
               <?/* <div style="width:100%;position: relative;" class="div-class" id="div3" value="3">
                    <img src="/img/pix.png" class="img-view" class="img-view" id="img3">
                    <input type="radio" name="<?=$var_name?>" value="3" style="position: absolute; top: 65px;left: 250px;">
                    <p style="position: absolute; top: 65px;left: 90px; color:#000;">ללא</p>
                </div>*/?>

                <a href="/altar/freize"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;margin-left: 20px;"></a>
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default" style="margin-left: 10px;">
            </form>
        </div>
        <div style="clear: both;"></div>
	</div>
</div>

<script>
/*
    $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');
    <?php if ($cornice==1) :?>
        $('#layer1').html('');
    <?php else: ?>
        $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
    <?php endif; ?>
    $('#layer2').html('<img src="/_altar/1/alt_door/alt_door'+<?=$door?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
    <?php if (($color == 1) || ($color == 2)) :?>
        <?php if ($freize == 1) :?>
            $('#layer3').html('<img src="/_altar/1/alt_freize_che/alt_freize_che'+<?=$type?>+'.png" id="layer-img">');
        <?php elseif (in_array($freize, array(2,3,4))): ?>
            $('#layer3').html('<img src="/_altar/1/alt_freize_rez/alt_freize_rez'+<?=$freize?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        <?php elseif (in_array($freize, array(5,6,7,8,9,10,11,12,13,14,15,16))): ?>
            <?php if ($freize == 5) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 6) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 7) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 8) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_4_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 9) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 10) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 11) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 12) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_4_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 13) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 14) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 15) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 16) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_4_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php endif;?>
        <?php endif;?>
    <?php else: ?>
        <?php if ($freize == 1) :?>
            $('#layer3').html('<img src="/_altar/1/alt_freize_che/alt_freize_che'+<?=$type?>+'.png" id="layer-img">');
        <?php elseif (in_array($freize, array(2,3,4))): ?>
            $('#layer3').html('<img src="/_altar/1/alt_freize_rez/alt_freize_rez'+<?=$freize?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        <?php elseif (in_array($freize, array(5,6,7,8,9,10))): ?>
            <?php if ($freize == 5) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 6) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 7) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 8) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 9) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 10) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php endif;?>
        <?php endif;?>
    <?php endif;?>
*/
    // Функция для выбора картинки
    $('input[name="<?=$var_name?>"]').change(function(){
        var num = this.value;
        sel(num);
    });

    $('.div-class').click(function(){
        var num = $(this).attr('value');
        sel(num);
    });

    function sel( num ) {
        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');
    }

</script>
