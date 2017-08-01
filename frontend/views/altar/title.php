<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title =  'פסוק';
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 250px;
        margin: 0px 20px 20px 20px;
        display: list-item;
        /*border: 2px solid #fff;*/
        background-color: #fff;
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
    #layer0, #layer1, #layer2, #layer3, #layer4{
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
                <div id="layer4" class="layer"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <form method="POST">
                <div style="text-align: center;font-size: x-large;">
                     כסף<input type="radio" onclick="relld()" name="color_t"  checked="checked" value="1" style="margin-right: 15px">
                    זהב<input type="radio" onclick="relld()" name="color_t" id="is_cr" value="2">
                </div>
                <br/>

                <div style="width:100%;position: relative;" class="div-class" id="div1" value="1">
                    <img src="/_altar/1/alt_title/nadpis1.png" class="img-view img-select" id="img1">
                    <input class="nps" type="radio" name="<?=$var_name?>" checked="checked" value="1" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">1</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div2" value="2">
                    <img src="/_altar/1/alt_title/nadpis2.png" class="img-view" id="img2">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="2" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">2</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div3" value="3">
                    <img src="/_altar/1/alt_title/nadpis3.png" class="img-view" id="img3">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="3" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">3</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div4" value="4">
                    <img src="/_altar/1/alt_title/nadpis4.png" class="img-view" id="img4">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="4" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">4</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div5" value="5">
                    <img src="/_altar/1/alt_title/nadpis5.png" class="img-view" id="img5">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="5" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">5</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div6" value="6">
                    <img src="/_altar/1/alt_title/nadpis6.png" class="img-view" id="img6">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="6" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">6</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div7" value="7">
                    <img src="/_altar/1/alt_title/nadpis7.png" class="img-view" id="img7">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="7" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">7</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div8" value="8">
                    <img src="/_altar/1/alt_title/nadpis8.png" class="img-view" id="img8">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="8" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">8</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div9" value="9">
                    <img src="/_altar/1/alt_title/nadpis9.png" class="img-view" id="img9">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="9" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">9</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div10" value="10">
                    <img src="/_altar/1/alt_title/nadpis10.png" class="img-view" id="img10">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="10" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">10</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div12" value="12">
                    <img src="/_altar/1/alt_title/nadpis12.png" class="img-view" id="img12">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="12" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 300px;">11</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div11" value="11">
                    <img src="/img/pix.png" class="img-view" id="img11" style="height: 40px;">
                    <input class="nps" type="radio" name="<?=$var_name?>" value="11" style="position: absolute; top: 10px;left: 320px;">
                    <p style="position: absolute; top: 10px;left: 140px;color:#000;">ללא</p>
                </div>

                <a href="/altar/verx"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;margin-left: 90px;"></a>
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default" style="margin-left: 10px;">
            </form>
        </div>
	</div>
</div>

<script>


    $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');

    <?php if ($cornice==1) :?>
        $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
    <?php else: ?>
        $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
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

    <?php if ( $verx != 3) : ?>
        <?php if ( $verx == 1) : ?>
            $('#layer4').html('<img src="/_altar/1/alt_verx_che/alt_verx_che'+<?=$cornice?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        <?php else : ?>
            $('#layer4').html('<img src="/_altar/1/alt_verx_rez/alt_verx_rez'+<?=$cornice?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        <?php endif; ?>
    <?php else : ?>
        $('#layer4').html('');
    <?php endif; ?>


    var corniceType = 1;
    // Функция для выбора картинки
    $('input[name="<?=$var_name?>"]').change(function(){
        var num = this.value;
        sel(num);
    });

    $('.div-class').click(function(){
        var num = $(this).attr('value');
        sel(num);
    });

    function relld() {
        sel( $('.img-select').parent().attr('value') );
    }

    function sel( num ) {
        var is_c = '';
        if($('#is_cr').prop( "checked" ))
            is_c = '_c';
        <?php if ($cornice==1) :?>
            if ( num == 11 ) {
                $('#layer1').html('');
            } else {
                $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice'+is_c+'1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            }
        <?php else: ?>
            if ( num == 11 ) {
                $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            } else {
                $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice'+is_c+'3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            }
        <?php endif; ?>
        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');

        $('.nps[value="'+num+'"]').prop('checked', 'checked');
    }

</script>
