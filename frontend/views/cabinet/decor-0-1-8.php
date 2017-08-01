<?php


//$this->registerJsFile('path/to/myfile');
//$this->registerCssFile('path/to/myfile');


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'אומנות על פסי הפרדה';
$this->params['breadcrumbs'][] = $this->title;

/**
 * Джава скрипт сам определяет номер мебели по ГЕТ запросу
 * и формирует Ajax запорс вида http://lavi.new-dating.com/site/furniture-ajax?id=1&action=get_colors
 * где подтягивает соотсветсвующие детали стула с нужным номером
 */
?>
<style>
    .type7 div.btnn > img {
        max-width: 80px !important;
        max-height: 80px !important;
        width: auto;
        height: auto;
    }

    .type7 #mynum
    {
        display: none;
    }

    .type7 .select {
        width: auto;
        height: auto;
        border: 2px solid #ff0000;
    }

    .type7 .btnn {
        width: auto;
        height: auto;
    }

    .img-select {
        border: 3px solid #ff0000;
    }
    .img-view {
        height: 450px;
        margin: 5px 20px 50px 20px;
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
    #layer10
    {
        position: absolute;
        z-index: 20;
    }
    #layer10 img{
        width: 650px;
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
                    <div style="width: 100%; overflow: auto;" class="all_imgs">
                        <div style="width:20%;position: relative; float: left;" class="div-class" id="div1" value="1" data-n="1">
                            <img src="/_cabinet/decor/friezeA_1.png" class="img-view img-select" id="img1">
                            <input type="radio" name="cornice" checked="checked" value="1" style="position: absolute; top: 7px; left: 73%;" data-n="1">
                        </div>
                        <div style="width:20%;position: relative; float: left;" class="div-class" id="div2" value="2" data-n="2">
                            <img src="/_cabinet/decor/friezeA_2.png" class="img-view" id="img2">
                            <input type="radio" name="cornice" value="2" style="position: absolute; top: 7px;left: 73%;" data-n="2">
                        </div>
                        <div style="width:20%;position: relative; float: left;" class="div-class" id="div3" value="3" data-n="3">
                            <img src="/_cabinet/decor/friezeA_3.png" class="img-view" id="img3">
                            <input type="radio" name="cornice" value="3" style="position: absolute; top: 7px; left: 73%;" data-n="3">
                        </div>
                        <div style="width:20%;position: relative; float: left;" class="div-class" id="div3" value="4" data-n="4">
                            <img src="/_cabinet/decor/friezeA_4.png" class="img-view" id="img4">
                            <input type="radio" name="cornice" value="4" style="position: absolute; top: 7px; left: 73%;" data-n="4">
                        </div>
                    </div>
                    <div style="clear: left;"></div>

                    <a href="/cabinet/capitel-0-1-8"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px; margin-left: 100px"></a>
                    <input type="submit" value="<?=Yii::t('common', 'Next step')?>" class="btn btn-style-default">
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
    $(document).ready(function()
    {
        $("#colorContainer .type7 li" ).removeClass('select');
        $("#colorContainer .type7 li:last-child" ).addClass('select');
    });

    $('input[name="cornice"]').change(function(){
        var num = this.value;
        sel(num);
    });

    $('.div-class').click(function(){
        var num = $(this).attr('value');

        //$('#layer2').html('<img src="/_cabinet/<?=$_COOKIE['numsections']?>/frieze/frieze<?=$_COOKIE['typefrieze']?>k_<?=$_COOKIE['typecabinet']?>_<?=$_COOKIE['colorcabinet']?>.png" id="layer-img">');
        sel(num);
    });

    $(document).on("click touchstart", ".tag1", function(e){
        set_imgs('A');
    });
    $(document).on("click touchstart", ".tag2", function(e){
        set_imgs('B');
    });
    $(document).on("click touchstart", ".tag3", function(e){
        set_imgs('C');
    });
    $(document).on("click touchstart", ".tag4", function(e){
        set_imgs('D');
    });

    function set_imgs(tag) {
        $('.all_imgs').find("img").each(function(i,elem) {
            $(this).attr('src','/_cabinet/decor/frieze'+tag+'_'+$(this).parent().attr('data-n')+'.png');
        });
    }



    function sel( num ) {
        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;

        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');
    }

    $(document).ready(function()
    {
        if(readCookie('typecapitel') && readCookie('typecapitel')!='none')
            $('#layer10').html('<img src="/_cabinet/<?=$_COOKIE['numsections']?>/frieze/frieze1k_<?=$_COOKIE['numsections']?>_<?=$_COOKIE['colorcabinet']?>.png" id="layer-img">');
    });

</script>
