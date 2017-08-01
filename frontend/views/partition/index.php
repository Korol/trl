<?php

use yii\helpers\Html;

$this->title = 'partition';
$this->params['breadcrumbs'][] = $this->title;

$cookies = Yii::$app->request->cookies;
$client_id = $cookies->getValue('dir_id_mfiles');
$client_name = $cookies->getValue('dir_name_mfiles');

$this->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

$type = [1,3];
$def = 1;
$np[1] = 'מחיצה ניידת סטנדרט';
$np[3] = 'מחיצה ניידת סטנדרט עם מוט';
?>

<style>
    #container {
        width:100%;
        height: auto;
        position: relative;
        padding-top: 20px;
		margin-bottom: 20px;
    }
    #container img
    {
        width: 100%;
        border: 4px solid white;
    }
    #layer0 {
        z-index: 5;
        margin-left: -4px;
        margin-top: -4px;
    }
    #layer1 {
        z-index: 6;
        margin-left: -4px;
        margin-top: -4px;
    }

    .btnn {
        cursor: pointer;
        overflow: hidden;
        padding: 0 !important;
    }

    .btnn img {
        /*width: 300px;*/
        height: 240px;
    }

    .img-select {
        border: 3px solid #ff0000;
    }
</style>

<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-6">
            <div id="container" class="container1">
                <div id="layer0" class="layer generalBG">
                    <img src="/_partition/base/per<?=$type[0]?>_0_1">
                    <span id="ttl" style="background: white;color: black;padding: 2px 10px;position: absolute;bottom: 0;right: 0;text-align: right;"><?=$np[$def]?></span>
                </div>
                <div id="layer1" class="layer"></div>
                <div id="layer2" class="layer"></div>
                <div id="layer3" class="layer"></div>
                <div id="layer4" class="layer"></div>
            </div>
        </div>

        <div class="col-lg-4 text-center">
            <div class="typeheader">
                <h2>Select type</h2>
            </div>
            <ul style="padding: 0; list-style: none;">
                <?
                foreach ($type as $tp)
                { ?>
                    <li class="select">
                        <div class="btnn" style="position: relative;">
                            <img src="/_partition/preview/per<?=$tp==3?2:$tp?>" data-ttl="<?=$np[$tp]?>" class="img-view <?=$def==$tp?'img-select':''?>" data-type="<?=$tp?>">
                            <input type="radio" name="color" value="<?=$tp?>" <?=$def==$tp?'checked="checked"':''?> id="tpp<?=$tp?>" style="position: absolute;top: 110px;left: 320px;">
                        </div>
                    </li>
                <? } ?>
            </ul>
            <a href="/partition/color?type=<?=$def?>" class="btn btn-style-default next_step">Next step</a>
        </div>
        <!--<div class="ws_shadow"></div>-->
    </div>
</div>

<script>
    $(document).on("click touchstart", ".img-view", function(e){
        e.preventDefault();
        var type = $(this).attr('data-type');
        var ttl = $(this).attr('data-ttl');
        if(type==3)
            type=2;
         history.pushState('', '', '/partition?type='+type);
         $('.next_step').attr('href','/partition/color?type='+type);
        $('.img-view').removeClass('img-select');
        $(this).addClass('img-select');
        $('#layer0 img').attr('src','/_partition/base/per'+$(this).attr('data-type')+'_0_1');
        $('#ttl').text(ttl);

        $('.btnn').find('input').removeAttr('checked');
        $('#tpp'+$(this).attr('data-type')).prop('checked', 'checked');
    });

</script>