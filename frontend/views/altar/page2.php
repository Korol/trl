<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title ='Page2';
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
        margin: auto;
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
    <h1 class="header-frame">הורדנו את העמוד הזה</h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row" style="height: 550px;">

        <div class="col-lg-10">

            <form method="POST">

                <p class="p-title"> ארון קודש דגם דביר, עם כיס פרוכת</p>
                <table class="t">
                    <tr class="row-radio">
                        <td style="width: 400px;">ארון קודש דגם דביר, עם כיס פרוכת, קרניז נמוך</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="1" checked="checked"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר, עם כיס פרוכת, קרניז גבוה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="2"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר, עם כיס פרוכת, קרניז נמוך, אומנות עליונה </td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="3"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר, עם כיס פרוכת, קרניז גבוה, אומנות עליונה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="4"></td>
                    </tr>
                </table>

                <p class="p-title"> ארון קודש דגם דביר, ללא כיס פרוכת</p>
                <table class="t">
                    <tr class="row-radio">
                        <td style="width: 400px;">ארון קודש דגם דביר, ללא כיס פרוכת, קרניז גבוה, אומנות עליונה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="5"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר, ללא כיס פרוכת, קרניז גבוה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="6"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר, ללא כיס פרוכת, קרניז נמוך</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="7"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר, ללא כיס פרוכת, קרניז נמוך, אומנות עליונה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="8"></td>
                    </tr>
                </table>

                <p class="p-title">ארון קודש דגם דביר נמוך, עם כיס פרוכת</p>
                <table class="t">
                    <tr class="row-radio">
                        <td style="width: 400px;">ארון קודש דגם דביר נמוך, עם כיס פרוכת, קרניז נמוך</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="9"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר נמוך, עם כיס פרוכת, קרניז גבוה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="10"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר נמוך, עם כיס פרוכת, קרניז נמוך, אומנות עליונה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="11"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר נמוך, עם כיס פרוכת, קרניז גבוה, אומנות עליונה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="12"></td>
                    </tr>
                </table>

                <p class="p-title"> ארון קודש דגם דביר נמוך, ללא כיס פרוכת</p>
                <table class="t">
                    <tr class="row-radio">
                        <td style="width: 400px;">ארון קודש דגם דביר נמוך, ללא כיס פרוכת, קרניז גבוה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="13"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר נמוך, ללא כיס פרוכת, קרניז נמוך</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="14"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר נמוך, ללא כיס פרוכת, קרניז נמוך, אומנות עליונה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="15"></td>
                    </tr>
                    <tr class="row-radio">
                        <td>ארון קודש דגם דביר נמוך, ללא כיס פרוכת, קרניז גבוה, אומנות עליונה</td>
                        <td class="td-radio"><input type="radio" name="<?=$var_name?>" value="16"></td>
                    </tr>
                </table>

                <br/>
                <a href="/altar/type"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px; margin-left: 40%;"></a>
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default" style="margin-right: 45%;">
            </form>
        </div>

        <?
        /*
         <div class="col-lg-6">
            <img src="/_altar/1/finder1.png" width="250px;" style="margin:40px 20px 20px 20px;">

            <img src="/_altar/1/finder2.png" width="250px;" style="margin:20px;">
        </div>
         */
        ?>


        <div style="clear: both;"></div>
	</div>
</div>

<script>
    $('.row-radio').click(function(){
        $('.row-radio').find('td').css('border', '1px solid #fff');
        $(this).find('td').css('border', '2px solid #f00');
        $(this).find('td.td-radio').find('input[type="radio"]').prop('checked', 'checked');
    });
</script>
