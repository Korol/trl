<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('common', 'Client Select');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>
    <h4><?= $client_name ?></h4>

    <p>&nbsp;</p>

    <p>&nbsp;</p>

    <div class="row">
        <div class="col-lg-5">

            <form method="post">
                <?php
                //                print_r($client_list);
                ?>
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>

                <?php


                echo '<p><label class="control-label" for="channels-remark_admin">' . Yii::t('common', 'Search by ID Client') . '</label>';
                echo "<input type=text class='form-control' name=search value='$request'> ";
                echo '<p><button type="submit" class="btn btn-style-default" name="search_button">' . Yii::t('common', 'Search') . '</button>';


                if ($client_list) {
                    echo '<p><p><label class="control-label" for="channels-remark_admin">' . Yii::t('common', 'Select the desired client from the list') . '</label>';
                    echo Html::dropDownList('client_id_mfiles', '', $client_list,
                            [
                                'prompt' => Yii::t('common', 'Dropdown list'),
                                'class' => 'form-control'
                            ]) . "<br>";
                    echo '<p><button type="submit" class="btn btn-style-default" name="dropbox_button">' . Yii::t('common', 'Select client') . '</button>';
                } else {
                    echo '<p><label class="control-label" for="channels-remark_admin">' . Yii::t('common', 'Client Not found') . '</label>';

                }


                ?>


            </form>


        </div>
    </div>

    <p>* The list of clients in real time is taken from this page <a
            href="http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/V6914">M-files</a>
    </p>

</div>
