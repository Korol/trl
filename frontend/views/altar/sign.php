<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = Yii::t('common', 'Altar') . ' - '. 'ארון קודש דביר';
    $this->params['breadcrumbs'][] = $this->title;
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
    #layer0, #layer1, #layer2, #layer3, #layer4, #layer5{
        position: absolute;
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
            <div id="container" class="container1">
                <div id="layer0" class="layer generalBG"></div>
                <div id="layer1" class="layer"></div>
                <div id="layer2" class="layer"></div>
                <div id="layer3" class="layer"></div>
                <div id="layer4" class="layer"></div>
                <div id="layer5" class="layer" style="display:none;"></div>
            </div>
            <div style="float:left;font-size: 16px;"><a id="dim">מידות</a></div>
        </div>

        <div class="col-lg-4">
            <form method="POST">
                <input type="hidden" name="process" value="1">

                <h4>הערות</h4>
                <textarea name="<?=$var_name?>" style="width:300px; height: 300px; color: #000;">...</textarea>

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

                <a href="/altar/page11"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;margin-left: 70px;margin-top: 20px"></a>
                <input type="submit" name="submit" value="Save" class="btn btn-style-default" style="margin-left: 10px; margin-top: 20px;">
            </form>

        </div>

	</div>
</div>

<script>

    $('#dim').click(function(){
        if ( $('#layer5').css('display') == 'block' ) {
            $('#layer5').css('display', 'none');
        } else {
            $('#layer5').css('display', 'block');
        }
    });

    $('#sig').click(function(){
        if ( $('#sig-div').css('display') == 'none' ) {
            $('#sig-div').css('display', 'block');
        } else {
            $('#sig-div').css('display', 'none');
        }
    });

    $('#layer0').html('<img src="/_altar/1/alt_type/altar'+<?=$originType?>+'_'+<?=$color?>+'.png" id="layer-img">');

    <?php if ($cornice==1) :?>
        if ( <?=$title?> == 11 ) {
            $('#layer1').html('');
        } else {
            $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice<?=$_SESSION['title_color_type']=='2'?'_c':''?>1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        }
    <?php else: ?>
        if ( <?=$title?> == 11 ) {
            $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        } else {
            $('#layer1').html('<img src="/_altar/1/alt_cornice/alt_cornice<?=$_SESSION['title_color_type']=='2'?'_c':''?>3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        }
    <?php endif; ?>

    $('#layer2').html('<img src="/_altar/1/alt_door/alt_door'+<?=$door?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');

    <?php if (($color == 1) || ($color == 2)) :?>
        <?php if ($freize == 1) :?>
            $('#layer3').html('<img src="/_altar/1/alt_freize_che/alt_freize_che'+<?=$type?>+'.png" id="layer-img">');
        <?php elseif (in_array($freize, array(2,3,4))): ?>
            $('#layer3').html('<img src="/_altar/1/alt_freize_rez/alt_freize_rez'+<?=$freize?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        <?php elseif (in_array($freize, array(5,6,7,8,9,10,11,12,13,14,15,16))): ?>
            <?php if ($freize == 5) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 6) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 7) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 8) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_4_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 9) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 10) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 11) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 12) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_4_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 13) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 14) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 15) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_3_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 16) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_4_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php endif;?>
        <?php endif;?>
    <?php else: ?>
        <?php if ($freize == 1) :?>
            $('#layer3').html('<img src="/_altar/1/alt_freize_che/alt_freize_che'+<?=$type?>+'.png" id="layer-img">');
        <?php elseif (in_array($freize, array(2,3,4))): ?>
            $('#layer3').html('<img src="/_altar/1/alt_freize_rez/alt_freize_rez'+<?=$freize?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        <?php elseif (in_array($freize, array(5,6,7,8,9,10))): ?>
            <?php if ($freize == 5) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 6) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz1_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 7) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 8) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz2_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 9) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_1_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php elseif ($freize == 10) :?>
                $('#layer3').html('<img src="/_altar/1/alt_freize_laz/alt_freize_laz3_2_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
            <?php endif;?>
        <?php endif;?>
    <?php endif;?>

    <?php if ( $verx != 3) : ?>
        <?php if ( $verx == 1) : ?>
            $('#layer4').html('<img src="/_altar/1/alt_verx_che/alt_verx_che'+<?=$cornice?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        <?php else : ?>
            $('#layer4').html('<img src="/_altar/1/alt_verx_rez/alt_verx_rez'+<?=$cornice?>+'_'+<?=$type?>+'_'+<?=$color?>+'.png" id="layer-img">');
        <?php endif; ?>
    <?php else : ?>
        $('#layer4').html('');
    <?php endif; ?>

    <?php if ($originType == 4) : ?>
        $('#layer5').html('<img src="/_altar/1/alt_dimentions/altar_dim1_2.png" id="layer-img">');
    <?php elseif ($originType == 3) : ?>
        $('#layer5').html('<img src="/_altar/1/alt_dimentions/altar_dim2_1.png" id="layer-img">');
    <?php elseif ($originType == 2) : ?>
        $('#layer5').html('<img src="/_altar/1/alt_dimentions/altar_dim2_2.png" id="layer-img">');
    <?php else : ?>
        $('#layer5').html('<img src="/_altar/1/alt_dimentions/altar_dim1_2.png" id="layer-img">');
    <?php endif; ?>
</script>
