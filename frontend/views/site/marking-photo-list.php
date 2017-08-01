<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'List of marking photo';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>


    <div class="row">


        <?php
        foreach ($list as $img_id) {
            echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail" href="/site/marking-photo?id=' . $img_id . '">
                <img class="img-responsive" src="/_making_photos/' . $img_id . '.PNG" alt="">
            </a>
            </div>';
        }
        ?>


    </div>


</div>
