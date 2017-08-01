<?php


//$this->registerJsFile('path/to/myfile');
//$this->registerCssFile('path/to/myfile');


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'מספר עמודות';
$this->params['breadcrumbs'][] = $this->title;

/**
 * Джава скрипт сам определяет номер мебели по ГЕТ запросу
 * и формирует Ajax запорс вида http://lavi.new-dating.com/site/furniture-ajax?id=1&action=get_colors
 * где подтягивает соотсветсвующие детали стула с нужным номером
 */


?>
<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>


    <div class="row">
        <div class="col-lg-6">
            <div id="container">
                <div id="layer0" class="layer generalBG"></div>
                <div id="layer1" class="layer"></div>
                <div id="layer2" class="layer"></div>
                <div id="layer3" class="layer"></div>
                <div id="layer4" class="layer"></div>
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
                    <h2>מספר עמודות</h2><br><br>

                    <input type="hidden" name="order[kitchenmodel]" value="2" id="kitchenmodel"/>

                    <input type="hidden" id="color_type_1" name="order[color_type1]" value="0"/>
                    <input type="hidden" id="color_type_2" name="order[color_type2]" value="0"/>
                    <input type="hidden" id="color_type_3" name="order[color_type3]" value="0"/>
                    <input type="hidden" id="color_type_4" name="order[color_type4]" value="0"/>

                    <p>
<!--                        <b>No alcove</b><br>-->
<!--                        <input type="radio" name="type_alcove" value="no_alcove" checked><br>-->

<!--                        <b>Number of sections</b><br>-->
                        <select name="number_sections">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </p>
                    <!--<hr>
                    <p>
                        <b>With alcove</b><br>
                        <input type="radio" name="type_alcove" value="with_alcove"><br>

                        <b>L</b><br>
                        <input type="text" name="wa_l"><br>

                        <b>Number</b><br>
                        <input type="text" name="wa_n">

                    </p>
                    <hr>

                    <p>
                        <b>Not standard</b><br>
                        <input type="radio" name="type_alcove" value="not_standart"><br>

                        <b>L</b><br>
                        <input type="text" name="ns_l"><br>

                        <b>B</b><br>
                        <input type="text" name="ns_b"><br>

                        <b>H</b><br>
                        <input type="text" name="ns_h"><br>

                    </p>-->

                    <br>

                    <div class="clear"></div>
                    <a href="/cabinet/color-0-0-1?type=<?=$_COOKIE['typecabinet']?>"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
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
