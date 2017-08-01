<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Marking photo';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modal"></div>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <h4>ID client : <b><?= $client_name ?></b></h4>

    <?php
    if (preg_match('/Chrome/', $_SERVER['HTTP_USER_AGENT'])) {
        echo '
  <div class="alert alert-info">
  <strong>Info!</strong> CHROME browser not supported for Photo by Webcam without HTTPS/SSL.
  Pls use Firefox browser for this page.
</div>
';
        return true;
    }

    //    $browser = get_browser(null, true);
    //    print_r($browser);
    ?>


    <div class="row">
        <div class="col-lg-6">
            <div id="my_camera"></div>
        </div>

        <div class="col-lg-1">
        </div>
        <div class="col-lg-5">


            <!-- Configure a few settings and attach camera -->
            <script language="JavaScript">


                Webcam.set({
                    width: 620,
                    height: 480,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                Webcam.attach('#my_camera');
                function take_snapshot() {
                    $body = $("body");
                    $body.addClass("loading");

                    // take snapshot and get image data
                    Webcam.snap(function (data_uri) {
                        // display results in page
                        document.getElementById('results').innerHTML = document.getElementById('results').innerHTML + ' ' + '<a href="' + data_uri + '" target=_blank><img width=100px src="' + data_uri + '"/></a>';
                        Webcam.upload(data_uri, '/mfiles/webcamphoto', function (code, text) {
                            $body = $("body");
                            $body.removeClass("loading");
                            alert('Done!');
                            // Upload complete!
                            // 'code' will be the HTTP response code from the server, e.g. 200
                            // 'text' will be the raw response content
                        });
                    });
                }


            </script>
            <div id="results" class="well">Your captured image will appear here...<br></div>
            <p>
                <?php
                // ищем только папки созданные киентом - я такие так и не научился создавать даже в ручну.!!!
                $params = '?limit=500&0_o=102&00_p0^=' . $client_name;
                // не все документы а только хранлище клиентов
                $url = 'http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/_tempsearch' . $params;

                ?>
                Result stored here in <a target="_blank"
                                         href="<?= $url ?>">M-Files</a>
            </p>
            <!-- A button for taking snaps -->
            <a href="#" onclick="take_snapshot();return false;" class="btn btn-success">Take Snapshot</a>


        </div>
    </div>


</div>
