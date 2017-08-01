<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'אומנות צד';
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 300px;
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
    #layer0, #layer1, #layer2, #layer3, #layer4{
        position: absolute;
    }
    .numbers {
        width: 100%;
    }
    .number {
        width: 66px;
        float: left;
    }
    .number p {
        text-align: center;
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
                <div id="layer2" class="layer"></div>
                <div id="layer3" class="layer"></div>

                <div class="fotorama" id="mfotorama"
                    data-width="650"
                    data-height="650"
                    data-direction="ltr"
                    data-nav="thumbs">
                    <img src="/_altar/1/alt_freize_che/alt_freize_che<?=$type?>.png"  data-caption="ריקוע גפן" class="img-view" alt='1'>
                    <img src="/_altar/1/alt_freize_rez/alt_freize_rez1_<?=$type?>_<?=$color?>.png"  data-caption="גילוף קשתות" class="img-view">
                    <img src="/_altar/1/alt_freize_rez/alt_freize_rez2_<?=$type?>_<?=$color?>.png"  data-caption="גילוף גפן" class="img-view">
                    <img src="/_altar/1/alt_freize_rez/alt_freize_rez3_<?=$type?>_<?=$color?>.png"  data-caption="גילוף שיבולים" class="img-view">
                    <img src="/_altar/1/alt_freize_laz/alt_freize_laz1_1_<?=$type?>_<?=$color?>.png"  data-caption="לייזר מגיני דוד זהב" class="img-view">
                    <img src="/_altar/1/alt_freize_laz/alt_freize_laz1_2_<?=$type?>_<?=$color?>.png"  data-caption="לייזר מגיני דוד כסף" class="img-view">
                    <?php if (($color==1) || ($color==2)) :?>
                        <img src="/_altar/1/alt_freize_laz/alt_freize_laz1_3_<?=$type?>_<?=$color?>.png"  data-caption="לייזר מגיני דוד חום בהיר" class="img-view">
                        <img src="/_altar/1/alt_freize_laz/alt_freize_laz1_4_<?=$type?>_<?=$color?>.png"  data-caption="לייזר מגיני דוד חום כהה" class="img-view">
                    <?php endif; ?>
                    <img src="/_altar/1/alt_freize_laz/alt_freize_laz2_1_<?=$type?>_<?=$color?>.png"  data-caption="לייזר רימונים זהב" class="img-view">
                    <img src="/_altar/1/alt_freize_laz/alt_freize_laz2_2_<?=$type?>_<?=$color?>.png"  data-caption="לייזר רימונים כסף" class="img-view">
                    <?php if (($color==1) || ($color==2)) :?>
                        <img src="/_altar/1/alt_freize_laz/alt_freize_laz2_3_<?=$type?>_<?=$color?>.png"  data-caption="לייזר רימונים חום בהיר" class="img-view">
                        <img src="/_altar/1/alt_freize_laz/alt_freize_laz2_4_<?=$type?>_<?=$color?>.png"  data-caption="לייזר רימונים חום כהה" class="img-view">
                    <?php endif; ?>
                    <img src="/_altar/1/alt_freize_laz/alt_freize_laz3_1_<?=$type?>_<?=$color?>.png"  data-caption="לייזר גפן זהב" class="img-view">
                    <img src="/_altar/1/alt_freize_laz/alt_freize_laz3_2_<?=$type?>_<?=$color?>.png"  data-caption="לייזר גפן כסף" class="img-view">
                    <?php if (($color==1) || ($color==2)) :?>
                        <img src="/_altar/1/alt_freize_laz/alt_freize_laz3_3_<?=$type?>_<?=$color?>.png"  data-caption="לייזר גפן חום בהיר" class="img-view">
                        <img src="/_altar/1/alt_freize_laz/alt_freize_laz3_4_<?=$type?>_<?=$color?>.png"  data-caption="לייזר גפן חום כהה" class="img-view">
                    <?php endif; ?>
                </div>
<!--                <div class="numbers">
                    <div class="number"><p>1</p></div>
                    <div class="number"><p>2</p></div>
                    <div class="number"><p>3</p></div>
                    <div class="number"><p>4</p></div>
                    <div class="number"><p>5</p></div>
                    <div class="number"><p>6</p></div>
                    <div class="number"><p>7</p></div>
                    <div class="number"><p>8</p></div>
                    <div class="number"><p>9</p></div>
                    <div class="number"><p>10</p></div>
                </div>-->
            </div>
        </div>

        <div class="col-lg-4" style="height: 650px;">
            <form method="POST" style="position: absolute;bottom: 0;">
                <input type="hidden" name="<?=$var_name?>" value="" id="<?=$var_name?>">

                <a href="/altar/door"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default" style="margin-left: 10px;">
            </form>
        </div>
	</div>
</div>

<script>

    $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');

    <?php if ($cornice==1) :?>
        $('#layer1').html('');
    <?php else: ?>
        $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
    <?php endif; ?>
    $('#layer2').html('<img src="/_altar/1/alt_door/alt_door'+<?=$door?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');

    $('#mfotorama').on('fotorama:show', function (e, fotorama) {
        $('#<?=$var_name?>').val((fotorama.activeIndex + 1));
    });
</script>
