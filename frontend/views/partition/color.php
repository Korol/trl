<?php

    $this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = 'גוון להמחשה בלבד';
    $this->params['breadcrumbs'][] = $this->title;

$cookies = Yii::$app->request->cookies;
$client_id = $cookies->getValue('dir_id_mfiles');
$client_name = $cookies->getValue('dir_name_mfiles');

$type = $_GET['type']==2?3:$_GET['type'];
?>

<style>
    #container {
        width:100%;
        height: auto;
        position: relative;
        margin-top: 20px;
		margin-bottom: 20px;
		padding-top: 0;
		float: none;
    }
    #container img
    {
        width: 100%;
        border: 4px solid white;
    }
    #layer0 {
        z-index: 5;
        margin-left: -4px;
        margin-top: 0;
		border: none;
        position: relative;
    }
    #layer1 {
        z-index: 6;
        margin-left: -4px;
        margin-top: 0;
		border: none;
		top: 0;
    }
	#layer0 img, #layer1 img, #layer2 img, #layer3 img, #layer4 img, #layer5 img, #layer6 img, #layer7 img, #layer8 img {
    width: 100%;
    height: auto;
}
    .img-select {
        border: 3px solid #ff0000;
    }
    .img-view {
        width: 120px;
        height: 120px;
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
</style>

<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-8">
            <div id="container">
                <div id="layer0" class="layer generalBG"><img src="/_partition/base/per<?=$type?>_0_1"></div>
                <div id="layer1" class="layer"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <form method="POST">
                <div style="width:100%;position: relative;" class="div-class" id="div1" value="1">
                    <img src="/_altar/1/alt_color/wood1.jpg" class="img-view img-select" id="img1">
                    <input type="radio" name="color" checked="checked" value="1" style="position: absolute; top: 50px;left: 220px;">
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div2" value="2">
                    <img src="/_altar/1/alt_color/wood2.jpg" class="img-view" id="img2">
                    <input type="radio" name="color" value="2" style="position: absolute; top: 50px;left: 220px;">
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div3" value="3">
                    <img src="/_altar/1/alt_color/wood3.jpg" class="img-view" id="img3">
                    <input type="radio" name="color" value="3" style="position: absolute; top: 50px;left: 220px;">
                </div>
                <div style="width:100%;position: relative;" class="div-class" id="div4" value="4">
                    <img src="/_altar/1/alt_color/wood4.jpg" class="img-view" id="img4">
                    <input type="radio" name="color" value="4" style="position: absolute; top: 50px;left: 220px;">
                </div>

                <a href="/partition?type=<?=$_GET['type']?>"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
                <a href="/partition/color_catalog?type=<?=$_GET['type']?>&color=1" class="btn btn-style-default next_step" style="margin-left: 25px;">Next step</a>
            </form>
        </div>

        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>
    // Функция для выбора картинки
    $('input[name="color"]').change(function(){
        var num = this.value;
        sel(num);
    });

    $('.div-class').click(function(){
        var num = $(this).attr('value');
        sel(num);
    });

    function sel( num ) {
        $('#layer1').html('<img src="/_partition/base/per<?=$type?>_0_'+num+'" id="layer-img" class="front">');

        history.pushState('', '', '/partition/color?type=<?=$_GET['type']?>&color='+num);
        $('.next_step').attr('href','/partition/color_catalog?type=<?=$_GET['type']?>&color='+num);

        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');
    }

</script>
