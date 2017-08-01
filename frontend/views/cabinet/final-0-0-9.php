<?php


//$this->registerJsFile('path/to/myfile');
//$this->registerCssFile('path/to/myfile');


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'סיום';
$this->params['breadcrumbs'][] = $this->title;

/**
 * Джава скрипт сам определяет номер мебели по ГЕТ запросу
 * и формирует Ajax запорс вида http://lavi.new-dating.com/site/furniture-ajax?id=1&action=get_colors
 * где подтягивает соотсветсвующие детали стула с нужным номером
 */
?>
<style>
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
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>


    <div class="row">
        <div class="col-lg-6">
            <div id="container">
                <div id="layer0" class="layer generalBG"></div>
                <div id="layer1" class="layer"></div>
                <div id="layer3" class="layer"></div>
                <div id="layer2" class="layer"></div>
                <div id="layer4" class="layer"></div>
                <div id="layer5" class="layer"></div>
                <div id="layer6" class="layer"></div>
                <div id="layer7" class="layer"></div>
                <div id="layer8" class="layer"></div>
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
                    <input type="hidden" id="color_type_8" name="order[color_type8]" value="0"/>

                    <h1>סיום</h1>
                    <h4>Comment to order</h4>
                    <textarea  name="order[comment]" style="width: 264px;"></textarea>


                    <div class="clear"></div>

                    <a href="/cabinet/doors-0-0-3"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
                    <input type="submit" value="<?= Yii::t('common', 'Save to PDF in M-files') ?>"
                           class="btn btn-style-default">
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
        if(readCookie('typecapitel') && readCookie('typecapitel')!='none')
            $('#layer10').html('<img src="/_cabinet/<?=$_COOKIE['numsections']?>/frieze/frieze1k_<?=$_COOKIE['numsections']?>_<?=$_COOKIE['colorcabinet']?>.png" id="layer-img">');
    });
</script>