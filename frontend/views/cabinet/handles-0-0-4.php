<?php


//$this->registerJsFile('path/to/myfile');
//$this->registerCssFile('path/to/myfile');


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Select Handles';
$this->params['breadcrumbs'][] = $this->title;

/**
 * Джава скрипт сам определяет номер мебели по ГЕТ запросу
 * и формирует Ajax запорс вида http://lavi.new-dating.com/site/furniture-ajax?id=1&action=get_colors
 * где подтягивает соотсветсвующие детали стула с нужным номером
 */


?>
<div class="site-signup">
    <h1  class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>


    <div class="row">
        <div class="col-lg-6" >
            <div id="container">
                <div id="layer0" class="layer generalBG"></div>
                <div id="layer1" class="layer"></div>
                <div id="layer2" class="layer"></div>
                <div id="layer3" class="layer"></div>
                <div id="layer4" class="layer"></div>
                <div id="layer6" class="layer"></div>
                <div id="layer7" class="layer"></div>
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
                    <input type="hidden" id="color_type_2" name="order[color_type2]" value="0"/>
                    <input type="hidden" id="color_type_3" name="order[color_type3]" value="0"/>
                    <input type="hidden" id="color_type_4" name="order[color_type4]" value="0"/>
                    <input type="hidden" id="color_type_6" name="order[color_type6]" value="0"/>
                    <input type="hidden" id="color_type_7" name="order[color_type7]" value="0"/>

                    <div class="clear"></div>
                    <input type="submit" value="<?=Yii::t('common', 'Next step')?>" class="btn btn-style-default">
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
