<?php

    $this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

$this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = 'decor';
    $this->params['breadcrumbs'][] = $this->title;

$cookies = Yii::$app->request->cookies;
$client_id = $cookies->getValue('dir_id_mfiles');
$client_name = $cookies->getValue('dir_name_mfiles');

$type = $_GET['type']==2?3:$_GET['type'];
?>

<style>

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

    #mfotorama
    {
        z-index: 1112!important;

    }
</style>

<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-7" style="height: 750px;">
            <div id="container">
                <div id="layer0" class="layer generalBG"><img src="/_partition/base/per2_0_1"></div>
                <div id="layer1" class="layer"><img src="/_partition/base/per2_0_<?=$_GET['color']?>"></div>
                <div id="layer2" class="layer"><img src="/_partition/niz/niz<?=$_GET['footer']?>_0_<?=$_GET['color']?>"></div>
                <div id="layer3" class="layer">
                    <div class="fotorama" id="mfotorama"
                         data-width="650"
                         data-height="650"
                         data-direction="rtl"
                         data-nav="thumbs">
                        <a href="/_partition/uzor/uzor7_0_<?=$_GET['color']?>"  data-caption="לייזר  - שיח אברהם"><img src="/_partition/preview/uzor7" class="img-view"></a>
                        <a href="/_partition/uzor/uzor6_0_<?=$_GET['color']?>" data-caption="לייזר  - תחרת וילנה"><img src="/_partition/preview/uzor6" class="img-view"></a>
                        <a href="/_partition/uzor/uzor5_0_<?=$_GET['color']?>" data-caption="לייזר - שבעת המינים"><img src="/_partition/preview/uzor5" class="img-view"></a>
                        <a href="/_partition/uzor/uzor4_0_<?=$_GET['color']?>" data-caption="לייזר - אור המנורה"><img src="/_partition/preview/uzor4" class="img-view"></a>
                        <a href="/_partition/uzor/uzor3_0_<?=$_GET['color']?>" data-caption="לייזר -סלסולי רימון"><img src="/_partition/preview/uzor3" class="img-view"></a>
                        <a href="/_partition/uzor/uzor2_0_<?=$_GET['color']?>" data-caption="לייזר - רימון וזית"><img src="/_partition/preview/uzor2" class="img-view"></a>
                        <a href="/_partition/uzor/uzor1_0_<?=$_GET['color']?>" data-caption="לייזר - רימונים" data-id="1"><img src="/_partition/preview/uzor1" class="img-view"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" style="height: 650px;">
            <form method="POST" style="position: absolute;bottom: 0;">
                <a href="/partition/footer?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>">
                    <img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;">
                </a>
                <a href="/partition/section?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?>&decor=1" class="btn btn-style-default next_step" style="margin-left: 25px;">Next step</a>
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

    $('#mfotorama').on('fotorama:show', function (e, fotorama) {
        var num = fotorama.activeIndex+1;

        history.pushState('', '', '/partition/decor?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?>&decor='+num);
        $('.next_step').attr('href','/partition/section?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=<?=$_GET['color_catalog']?>&footer=<?=$_GET['footer']?>&decor='+num);
    });


</script>
