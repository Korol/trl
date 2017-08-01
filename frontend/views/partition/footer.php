<?php

    $this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = 'footer';
    $this->params['breadcrumbs'][] = $this->title;

$cookies = Yii::$app->request->cookies;
$client_id = $cookies->getValue('dir_id_mfiles');
$client_name = $cookies->getValue('dir_name_mfiles');

$type = $_GET['type']==2?3:$_GET['type'];
?>

<style>
    #container {
		width: 100%;
		height: 100%;
		float: none;
		padding-top: 0;
    }
    #container img
    {
        border: 4px solid white;
    }
    #layer0 {
		position: relative;
		border: none;
    }
    #layer1 {
		top: 0;
		margin: 0;
		border: none;
    }
	#layer0 img, #layer1 img, #layer2 img, #layer3 img, #layer4 img, #layer5 img, #layer6 img, #layer7 img, #layer8 img {
    width: 100%;
    height: auto;
}
    .img-select {
        border: 3px solid #ff0000;
    }
    .img-view {
        height: 180px;
        margin: 20px;
        display: list-item;
    }
    #layer-img {
        width: 650px;
        height: 650px;
    }
    .front{
        /*z-index: 100;*/
    }

    #layer1
    {
        z-index: 10;
    }
    #layer2
    {
        z-index: 11;
		top: 0;
		margin: 0;
		border: none;
    }
</style>

<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-7">
            <div id="container">
                <div id="layer0" class="layer generalBG"><img src="/_partition/base/per<?=$type?>_0_1"></div>
                <div id="layer1" class="layer"><img src="/_partition/base/per<?=$type?>_0_<?=$_GET['color']?>">
                </div>
                <div id="layer2" class="layer"></div>
            </div>
            <span id="ttl" style="background: white;color: black;padding: 2px 10px;position: absolute;bottom: 4px;right: 17px;text-align: right;z-index: 111">פלטה מחיצה ניידת סטנדרט</span>
        </div>


        <div class="col-lg-4">
            <form method="POST">
                <div style="width:100%;position: relative;" class="div-class" id="div1" value="1">
                    <span style="display: inline-block;position: relative;">
                    	<img src="/_partition/preview/niz1.png" data-ttl="פלטה מחיצה ניידת סטנדרט" class="img-view img-select" id="img1">
                    </span>
                    <input type="radio" name="color" checked="checked" value="1" style="position: absolute;top: 78px; left: 260px;">
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div2" value="2">
                   <span style="display: inline-block;position: relative;">
                        <img src="/_partition/preview/niz2.png" data-ttl="פלטה מחיצה ניידת סטנדרט עם סירגול" class="img-view" id="img2">
                    </span>
                    <input type="radio" name="color" value="2" style="position: absolute;top: 80px;left: 260px;">
                </div>

                <a href="/partition/color_catalog?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>">
                    <img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;">
                </a>
                <?
                if($_GET['type']!='1')
                { ?>
                    <a href="/partition/decor?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=1" class="btn btn-style-default next_step" style="margin-left: 25px;">Next step</a>
             <? } else { ?>
                    <a href="/partition/section?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=1" class="btn btn-style-default next_step" style="margin-left: 25px;">Next step</a>
             <? } ?>

            </form>
        </div>

        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>
    // Функция для выбора картинки
    $('input[name="color"]').change(function(){ ///_partition/niz/niz1_0_1.png
        var num = this.value;
        sel(num);
    });

    $('.div-class').click(function(){
        var num = $(this).attr('value');
        sel(num);
    });

    function sel( num ) {
        $('#layer2').html('<img src="/_partition/niz/niz'+num+'_0_<?=$_GET['color']?>" id="layer-img" class="front">');

        history.pushState('', '', '/partition/footer?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer='+num);
        <?
        if($_GET['type']!='1')
        { ?>
            $('.next_step').attr('href','/partition/decor?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer='+num);
        <? } else { ?>
            $('.next_step').attr('href','/partition/section?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer='+num);
        <? } ?>


        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');

        var ttl = $('#img'+num).attr('data-ttl');
        $('#ttl').text(ttl);
    }

</script>
