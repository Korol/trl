<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $gallery_model->name_gallery;
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-signup">
    <h1  class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>


    <div class="row">


        <?php
        foreach ($list as $item) {
            if (isset($item->files[0])) {
                echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="/site/marking-photo?id=' . $item->files[0]->id . '">
                        <img src="/attachments/file/download?id=' . $item->files[0]->id . '">
                    </a>
                    </div>';
            }
        }
        ?>


    </div>


</div>
