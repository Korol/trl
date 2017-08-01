<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = 'ארון קודש דביר';
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 650px;
        height: 650px;
    }

    .img_altr {
        margin:33px 10px 10px 20px;
        padding-top: 230px;
        width:250px;
        padding-left:20px;
        background-image:url('/_altar/1/altar1_2tkan.png');
        background-size: contain;
        height: 250px;
    }
    .img_altr2 {
        margin:33px 10px 10px 20px;
        padding-top: 230px;
        width:250px;
        padding-left:20px;
        background-image:url('/_altar/1/altar3_4tkan.png');
        background-size: contain;
        height: 250px;
    }
</style>

<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-6">
            <div class="fotorama" id="mfotorama"
                 data-width="620"
                 data-height="620"
                 data-direction="rtl"
                 data-nav="thumbs">
                <img src="/_altar/1/alt_<?=$var_name?>/altar1_1.png"  data-caption="ארון קודש דביר ללא כיס פרוכת" class="img-view">
                <img src="/_altar/1/alt_<?=$var_name?>/altar2_1.png"  data-caption="ארון קודש דביר נמוך ללא כיס פרוכת" class="img-view">
                <img src="/_altar/1/alt_<?=$var_name?>/altar3_1.png"  data-caption="ארון קודש דביר נמוך עם כיס פרוכת" class="img-view">
                <img src="/_altar/1/alt_<?=$var_name?>/altar4_1.png"  data-caption="ארון קודש דביר עם כיס פרוכת" class="img-view">
            </div>
        </div>

        <div class="col-lg-6" style="height: 600px">
            <div class="img_altr" style="text-align: right;">
                <span style="background: white;color: black; padding: 2px 10px;">תמונה להמחשה ארון ללא כיס פרוכת</span>
            </div>
            <div class="img_altr2" style="text-align: right;">
                <span style="background: white;color: black; padding: 2px 10px;">הדמיה להמחשה ארון עם כיס פרוכת</span>
            </div>


            <form method="POST" style="position: absolute;bottom: -20px; left: 20%;">
                <input type="hidden" name="<?=$var_name?>" value="" id="<?=$var_name?>">
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default">
            </form>
        </div>

        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>
    $('#mfotorama').on('fotorama:show', function (e, fotorama) {
        $('#<?=$var_name?>').val((fotorama.activeIndex + 1));
    });
</script>
