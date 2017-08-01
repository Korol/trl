<?php

$this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

$this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'אומנות קפיטל';
$this->params['breadcrumbs'][] = $this->title;

$var_name = 'capitel';

//var_dump($_COOKIE['typefrieze'])
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

    #layer10
    {
        position: absolute;
        z-index: 20;
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
                <div id="layer10" class="layer"></div>
                <!--                        <div id="generalBG"><img src="" alt=""/></div>-->
            </div>
        </div>

        <div class="col-lg-1">
        </div>

        <div class="col-lg-5">

            <div class="colors" id="colorContainer"></div>

        </div>

        <div class="col-lg-6">

            <div class="myform">
                <form method="POST">

                    <input type="hidden" name="order[kitchenmodel]" value="2" id="kitchenmodel"/>

                    <input type="hidden" id="color_type_1" name="order[color_type1]" value="0"/>
                    <input type="hidden" id="color_type_3" name="order[color_type3]" value="0"/>
                    <input type="hidden" id="color_type_2" name="order[color_type2]" value="0"/>
                    <input type="hidden" id="color_type_4" name="order[color_type4]" value="0"/>
                    <input type="hidden" id="color_type_5" name="order[color_type5]" value="0"/>
                    <input type="hidden" id="color_type_6" name="order[color_type6]" value="0"/>
                    <input type="hidden" id="color_type_7" name="order[color_type7]" value="0"/>

                    <div class="clear"></div>

                    <div style="width:100%;position: relative;" class="div-class" id="div1" value="1">
                        <img src="/_cabinet/capitel/empty.png" class="img-view" id="img1">
                        <input type="radio" name="<?=$var_name?>" value="1" style="position: absolute; top: 65px;left: 250px;">
                        <p style="position: absolute; top: 65px;left: 90px; display: none">1</p>
                    </div>
                    <div style="width:100%;position: relative;" class="div-class" id="divnone" value="none">
                        <img src="/img/pix.png" class="img-view img-select" id="imgnone">
                        <input type="radio" name="<?=$var_name?>" checked="checked" value="none" style="position: absolute; top: 65px;left: 250px;">
                        <p style="position: absolute; top: 65px;left: 90px; color:#000;">ללא</p>
                    </div>

                    <a href="/cabinet/frieze-0-0-8"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px; margin-left: 10px;"></a>
                    <input type="submit" name="submit" value="<?=Yii::t('common', 'Next step')?>" class="btn btn-style-default">
                </form>
            </div>


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
    // Функция для выбора картинки
    $('input[name="<?=$var_name?>"]').change(function(){
        var num = this.value;
        sel(num);
    });

    $('.div-class').click(function(){
        var num = $(this).attr('value');
        console.log(num);
        if(num!='none')
        {
            $('#layer3').html('<img src="/_cabinet/<?=$_COOKIE['numsections']?>/cornice/cornice<?=$_COOKIE['typecornice']?>k_<?=$_COOKIE['numsections']?>_<?=$_COOKIE['colorcabinet']?>.png" id="layer-img">');
            $('#layer10').html('<img src="/_cabinet/<?=$_COOKIE['numsections']?>/frieze/frieze1k_<?=$_COOKIE['numsections']?>_<?=$_COOKIE['colorcabinet']?>.png" id="layer-img">');
        }
        else
        {
            $('#layer3').html('<img src="/_cabinet/<?=$_COOKIE['numsections']?>/cornice/cornice<?=$_COOKIE['typecornice']?>_<?=$_COOKIE['numsections']?>_<?=$_COOKIE['colorcabinet']?>.png" id="layer-img">');
            $('#layer10').html('');
        }

        ///_cabinet/4/cornice/cornice4k_4_1.png


        sel(num);
    });

    function sel( num ) {
        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');
    }
</script>