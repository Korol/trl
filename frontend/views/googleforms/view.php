<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;


?>
<div>
    <h1  class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">
        <div class="col-lg-12">
            <!--//http://stackoverflow.com/questions/20108511/is-it-possible-to-prefill-a-google-form-using-data-from-a-google-spreadsheet-->
            <iframe
                style="border: 4px solid;"
                src="<?= $model->google_id ?>?embedded=true&<?= $model->comment ?>=<?= $client_name ?>"
                height="500" width="100%" frameborder="0" marginwidth="0" marginheight="0"></iframe>


            <h3><?= Yii::t('common', 'Date and signature') ?></h3>

            <p>
                <canvas id="tools_sketch" width="500px" height="300" style="border: 1px solid;"></canvas>
            </p>

            <p>

            <div class="tools" style="width: 500px">
                <a href="#tools_sketch" data-download="png" class="btn btn-style-default"><?= Yii::t('common', 'Save and upload result') ?></a>


                <!--                <a href="#tools_sketch" data-download="png" style="float: right; width: 100px;">Download</a>-->


                <a href="#tools_sketch" data-tool="marker" class="btn btn-info"
                   style="float: right; margin-right: 10px;"><?= Yii::t('common', 'Marker') ?></a>

                <a href="#tools_sketch" data-tool="eraser" class="btn btn-info"
                   style="float: right; margin-right: 10px;"><?= Yii::t('common', 'Eraser') ?></a>
            </div>
            </p>

            <br><br>

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


        </div>


    </div>
</div>
