<?php

    $this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'קרניז';
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-select {
        border: 3px solid #ff0000;
    }
    .img-view {
        width: 300px;
        margin: 50px 20px 50px 20px;
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
            </div>
        </div>

        <div class="col-lg-4">
            <form method="POST">
                <div style="width:100%;position: relative;" class="div-class" id="div1" value="1">
                    <img src="/_altar/1/alt_cornice/cornice1.png" class="img-view img-select" id="img1">
                    <input type="radio" name="<?=$var_name?>" checked="checked" value="1" style="position: absolute; top: 35px;left: 350px;">
                    <p style="position: absolute; top: 35px;left: 170px;">1</p>
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div2" value="2">
                    <img src="/_altar/1/alt_cornice/cornice2.png" class="img-view" id="img2">
                    <input type="radio" name="<?=$var_name?>" value="2" style="position: absolute; top: 35px;left: 350px;">
                    <p style="position: absolute; top: 35px;left: 170px;">2</p>
                </div>

                <a href="/altar/page4" style="margin-left: 80px;"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default" style="margin-left: 10px;">
            </form>
        </div>

        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>

    // Положим на первый слой картинку с фоном
    $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');


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
        if ( num == 1 ) {
            if ( <?=$originType?> == 4 ) {
                $('#layer0').html('<img src="/_altar/1/alt_type/altar3_'+<?=$color?>+'.png" id="layer-img">');
            }
            $('#layer1').html('');
        } else {
            if ( <?=$originType?> == 4 ) {
                $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');
            }
            $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        }
        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');
    }

</script>
