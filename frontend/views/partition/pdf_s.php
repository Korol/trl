<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'ארון קודש דביר';
$this->params['breadcrumbs'][] = $this->title;

$cookies = Yii::$app->request->cookies;
$client_id = $cookies->getValue('dir_id_mfiles');
$client_name = $cookies->getValue('dir_name_mfiles');
?>

<style>
    .img-view {
        width: 250px;
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
		position: absolute;
    }
    #layer2
    {
        z-index: 11;
		top: 0;
		margin: 0;
		border: none;
		position: absolute;
    }
    #layer3
    {
        z-index: 12;
		top: 0;
		margin: 0;
		border: none;
		position: absolute;
    }
</style>
<?
$decor = isset($_GET['decor'])?$_GET['decor']:0;
?>
<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">
        <div class="col-lg-8">
            <div id="container" class="container1">
                <div id="layer0" class="layer generalBG"><img src="/_partition/base/per<?=$_GET['type']?>_<?=$_GET['section']?>_1"></div>
                <div id="layer1" class="layer"><img src="/_partition/base/per<?=$_GET['type']?>_<?=$_GET['section']?>_<?=$_GET['color']?>"></div>
                <div id="layer2" class="layer"><img src="/_partition/niz/niz<?=$_GET['footer']?>_<?=$_GET['section']?>_<?=$_GET['color']?>"></div>
                <? if($decor)
                { ?>
                    <div id="layer3" class="layer"><img src="/_partition/uzor/uzor<?=$decor?>_<?=$_GET['section']?>_<?=$_GET['color']?>" id="layer-img" class="front"></div>
             <? } ?>

            </div>
            <div style="font-size: 16px;"><a id="dim">מידות</a></div>
        </div>

        <div class="col-lg-4">
            <form method="POST">
                <input type="hidden" name="process" value="1">

                <h4>הערות</h4>
                <textarea name="text" style="width:300px; height: 300px; color: #000;">...</textarea>

                <?php if ( false && isset($model)) : ?>
                    <h4 id="sig"><?= Yii::t('common', 'Signature') ?></h4>
                    <div id="sig-div" style="display:none;">
                        <p>
                            <canvas id="tools_sketch1" width="300px" height="200" style="border: 1px solid;"></canvas>
                            <a href="#tools_sketch1" data-download="png" class="btn btn-style-default">Save and upload result</a>
                        </p>
                        <!--<div style="clear: both;"></div>-->
                    </div>
                <?php endif; ?>

                <p>
                    <?php
                    // ищем только папки созданные киентом - я такие так и не научился создавать даже в ручну.!!!
                    $params = '?limit=500&0_o=102&00_p0^=' . $client_name;
                    // не все документы а только хранлище клиентов
                    //mfiles.lavi.co.il не открываюся в офисе клиента
                    $url = 'http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/_tempsearch' . $params;
                    ?>
                    <?= Yii::t('common', 'Result will be stored here in') ?> <a target="_blank"
                                                                                href="<?= $url ?>">M-Files</a>
                </p>

                <a href="/partition/section?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?><?=$decor?'&decor='.$_GET['decor']:''?>"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;margin-left: 70px;margin-top: 20px"></a>
                <a href="/partition/pdf-result?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?><?=$decor?'&decor='.$_GET['decor']:''?>&section=<?=$_GET['section']?>" class="btn btn-style-default" style="margin-left: 10px; margin-top: 20px;">Save</a>
            </form>

        </div>

    </div>
</div>
