<?php


//$this->registerJsFile('path/to/myfile');
//$this->registerCssFile('path/to/myfile');


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'נושאי מדף';
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

    <form method="POST">

        <div class="row">

            <div class="myform">
                <h1>נושאי מדף</h1>

                <div class="col-lg-4">

                    <p>
                        <b>חורים בדופן לנושאי מדף</b><br>
                        <img src="/images/shelf001.png" width="350px"  height="350px" style="border: 4px solid black;">
                        <br>

                        <input type="radio" name="shelmounting_type" value="1" checked><br><br>
                    </p>
                </div>
                <div class="col-lg-4">

                    <p>
                        <b>פסי אלומיניום בצבע כסף</b><br>
                        <img src="/images/shelf002.png" width="350px"  height="350px" style="border: 4px solid black;">
                        <br>
                        <input type="radio" name="shelmounting_type" value="2"><br>


                    </p>
                </div>
                <div class="col-lg-4">

                    <p>
                        <b>פסי אלומיניום בצבע זהב</b><br>
                        <img src="/images/shelf003.png" width="350px"  height="350px" style="border: 4px solid black;">
                        <br>
                        <input type="radio" name="shelmounting_type" value="3"><br>


                    </p>
                </div>
                <hr>
                <div class="clear"></div>
            </div>


        </div>

        <a href="/cabinet/decor-0-1-8"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
        <input type="submit" value="<?=Yii::t('common', 'Next step')?>" class="btn btn-style-default">
    </form>


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
