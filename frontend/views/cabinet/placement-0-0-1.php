<?php


//$this->registerJsFile('path/to/myfile');
//$this->registerCssFile('path/to/myfile');


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Placement in the alcove';
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
                <h1>Placement in the alcove</h1>

                <div class="col-lg-4">

                    <p id=pls1>
                        <b>Type 1</b><br>
                        <img src="/images/placement003.png" height="300px" >
                        <br>

                        <input type="radio" name="alcovemounting_type" value="1" checked><br><br>
                    </p>
                </div>
                <div class="col-lg-4">

                    <p id=pls1>
                        <b>Type 2</b><br>
                        <img src="/images/placement002.png" height="300px" >
                        <br>
                        <input type="radio" name="alcovemounting_type" value="2"><br>

                    </p>
                </div>


                <div class="col-lg-4">

                    <p id=pls1>
                        <b>Type 3</b><br>
                        <img src="/images/placement004.png" height="300px"  >
                        <br>
                        <input type="radio" name="alcovemounting_type" value="3"><br>

                    </p>
                </div>


                <div class="clear"></div>
            </div>


        </div>

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
