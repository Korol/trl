<?php

    $this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = 'section';
    $this->params['breadcrumbs'][] = $this->title;

$cookies = Yii::$app->request->cookies;
$client_id = $cookies->getValue('dir_id_mfiles');
$client_name = $cookies->getValue('dir_name_mfiles');

$type = $_GET['type']==2?3:$_GET['type'];
?>

<style>
    .img-select {
        border: 3px solid #ff0000;
    }
    .img-view {
        height: 80px;
        margin: 10px;
        display: list-item;
    }
    #layer-img {
        width: 650px;
        height: 650px;
    }
    .front{
        /*z-index: 100;*/
    }

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
	#layer0 img, #layer1 img, #layer2 img, #layer3 img, #layer4 img, #layer5 img, #layer6 img, #layer7 img, #layer8 img {
    width: 100%;
    height: auto;
}

     #layer0 {
		position: relative;
		border: none;
    }
    #layer1
    {
        z-index: 10;
		top: 0;
		margin: 0;
		border: none;
    }
    #layer2
    {
        z-index: 11;
		top: 0;
		margin: 0;
		border: none;
    }
    #layer3
    {
        z-index: 12;
		top: 0;
		margin: 0;
		border: none;
    }
</style>
<?
$decor = isset($_GET['decor'])?$_GET['decor']:0;
?>
<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-7">
            <div id="container">
                <div id="layer0" class="layer generalBG"><img src="/_partition/base/per<?=$_GET['type']?>_0_1"></div>
                <div id="layer1" class="layer"><img src="/_partition/base/per<?=$_GET['type']?>_0_<?=$_GET['color']?>"></div>
                <div id="layer2" class="layer"><img src="/_partition/niz/niz<?=$_GET['footer']?>_0_<?=$_GET['color']?>"></div>
             <? if($decor)
                { ?>
                    <div id="layer3" class="layer"><img src="/_partition/uzor/uzor<?=$decor?>_0_<?=$_GET['color']?>" id="layer-img" class="front"></div>
             <? } ?>

            </div>
        </div>

        <div class="col-lg-3 text-center">
            <h2>מספר עמודות</h2><br><br>
            <div style="margin: -20px 0 20px;"><select name="number_sections" onchange="showOption(this)" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select></div>

            <a href="/partition/<?=$decor?'decor':'footer'?>?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?><?=$decor?'&decor='.$_GET['decor']:''?>">
                <img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" width="45" >
            </a>
            <a href="/partition/pdf?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?><?=$decor?'&decor='.$_GET['decor']:''?>&section=1"
               class="btn btn-style-default next_step" >Next step</a>
        </div>

        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>
    function showOption(el)
    {
        sel(el.options[el.selectedIndex].value);
    }

    function sel( num ) {

        $('#layer0').html('<img src="/_partition/base/per<?=$_GET['type']?>_'+num+'_1">');
        $('#layer1').html('<img src="/_partition/base/per<?=$_GET['type']?>_'+num+'_<?=$_GET['color']?>">');
        $('#layer2').html('<img src="/_partition/niz/niz<?=$_GET['footer']?>_'+num+'_<?=$_GET['color']?>">');
        <? if($decor)
        { ?>
            $('#layer3').html('<img src="/_partition/uzor/uzor<?=$_GET['decor']?>_'+num+'_<?=$_GET['color']?>">');
     <? } ?>


        history.pushState('', '', '/partition/section?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?><?=$decor?'&decor='.$_GET['decor']:''?>&section='+num);
        $('.next_step').attr('href','/partition/pdf?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?><?=$decor?'&decor='.$_GET['decor']:''?>&section='+num);

        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');
    }

</script>
