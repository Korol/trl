<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Page11';
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 150px;
        margin: 0px 20px 20px 20px;
        display: list-item;
        /*border: 2px solid #fff;*/
    }
    .img-select {
        border: 3px solid #ff0000;
    }
    #layer-img {
        width: 650px;
        height: 650px;
    }
    .container1{
        position: relative;
        height: 650px;
    }
    #layer0, #layer1, #layer2, #layer3{
        position: absolute;
    }

    .t {
        /*margin: auto;*/
    }
    .t tr td {
        padding: 7px;
        border: 1px solid #fff;
    }
    .p-title {
        margin-top: 25px;
        font-size: 18px;
        text-align: center;
    }
</style>

<div class="site-signup">
    <h1 class="header-frame">פרטים נוספים</h1>
    <h4><b><?= $client_name ?></b></h4

    <div class="row" style="height: 550px;">

        <div class="col-lg-12">
            <form method="POST">
                <table class="t">
                    <tr>
                        <td style="width:300px;">נייד (על גלגלים)</td>
                        <td>
                            כן &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_1" value="2">
                            לא &nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_1" value="1" checked="checked">
                        </td>
                    </tr>
                    <tr>
                        <td>מיגון פח הקפי</td>
                        <td>
                            כן&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_2" value="2">
                            לא&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_2" value="1" checked="checked">

                        </td>
                    </tr>
                    <tr>
                        <td>מיגון סורג טרילידור</td>
                        <td>
                            כן&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_3" value="2">
                            לא&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_3" value="1" checked="checked">
                        </td>
                    </tr>
                    <tr>
                        <td>מחיצות פנים (לספרים אשכנזים)</td>
                        <td>
                            כן&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_4" value="2">
                            לא&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_4" value="1" checked="checked">
                        </td>
                    </tr>
                    <tr>
                        <td>סוג עץ ופורניר</td>
                        <td>
                            מהגוני&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_5" value="1" checked="checked">
                     אחר ע"פ המפרט&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?=$var_name?>_5" value="2">
                        </td>
                    </tr>

                </table>

                <a href="/altar/title"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;margin-left: 170px;margin-top: 20px"></a>
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default" style="margin-left: 10px;margin-top: 20px;">
            </form>
        </div>
        <div style="clear: both;"></div>
	</div>
</div>
