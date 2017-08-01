<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

$cookies = Yii::$app->request->cookies;
$client_id = $cookies->getValue('dir_id_mfiles');
$client_name = $cookies->getValue('dir_name_mfiles');

    $this->title = 'Color catalog';
    $this->params['breadcrumbs'][] = $this->title;

$var_name = 'color_catalog';
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

</style>

<div class="site-signup">
    <h1 class="header-frame">בירת גוון מקטלוג משווק</h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row" style="height: auto;">
        <form method="POST">
            <div class="col-lg-4">
                    <div style="width:100%;position: relative;" class="div-class" id="div9" value="9">
                        <img src="/_altar/1/alt_color/b13.png" class="img-view img-select" id="img9">
                        <input type="radio" name="<?=$var_name?>" checked="checked" value="9" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute; top: 65px;left: 85px;">b13</p>
                    </div>
                    <div style="width:100%;position: relative;" class="div-class" id="div10" value="10">
                        <img src="/_altar/1/alt_color/b19.png" class="img-view" id="img10">
                        <input type="radio" name="<?=$var_name?>" value="10" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute; top: 65px;left: 85px;">b19</p>
                    </div>

                    <div style="width:100%;position: relative;" class="div-class" id="div12" value="12">
                        <img src="/_altar/1/alt_color/b_2.png" class="img-view" id="img12">
                        <input type="radio" name="<?=$var_name?>" value="12" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute; top: 65px;left: 85px;">טבעי</p>
                    </div>
                    <div style="width:100%;position: relative;" class="div-class" id="div14" value="14">
                        <img src="/_altar/1/alt_color/bwhite.png" class="img-view" id="img14">
                        <input type="radio" name="<?=$var_name?>" value="14" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute; top: 65px;left: 55px;color: black">אחר ע"פ המפרט</p>
                    </div>
            </div>

            <div class="col-lg-4">
                    <div style="width:100%;position: relative;" class="div-class" id="div8" value="8">
                        <img src="/_altar/1/alt_color/b11.png" class="img-view" id="img8">
                        <input type="radio" name="<?=$var_name?>" value="8" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute; top: 65px;left: 85px;">b11</p>
                    </div>
                    <div style="width:100%;position: relative;" class="div-class" id="div1" value="5">
                        <img src="/_altar/1/alt_color/b21.png" class="img-view" id="img5">
                        <input type="radio" name="<?=$var_name?>" value="5" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute;top: 65px;left: 85px;">b21</p>
                    </div>
                    <div style="width:100%;position: relative;" class="div-class" id="div11" value="11">
                        <img src="/_altar/1/alt_color/b22.png" class="img-view" id="img11">
                        <input type="radio" name="<?=$var_name?>" value="11" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute; top: 65px;left: 85px;">b22</p>
                    </div>
                    <div style="width:100%;position: relative;" class="div-class" id="div2" value="6">
                        <img src="/_altar/1/alt_color/b23.png" class="img-view" id="img6">
                        <input type="radio" name="<?=$var_name?>" value="6" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute; top: 65px;left: 85px;">b23</p>
                    </div>
                    <div style="width:100%;position: relative;" class="div-class" id="div3" value="7">
                        <img src="/_altar/1/alt_color/b24.png" class="img-view" id="img7">
                        <input type="radio" name="<?=$var_name?>" value="7" style="position: absolute; top: 65px;left: 220px;">
                        <p style="position: absolute; top: 65px;left: 85px;">b24</p>
                    </div>


                    <a href="/partition/color?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>"><img src="/img/back.png" title="<?=Yii::t('common', 'Back')?>" style="width: 45px;"></a>
                    <a href="/partition/footer?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog=9" class="btn btn-style-default" style="margin-left: 10px;">Next step</a>
            </div>
        </form>
        <div style="clear: both;"></div>
	</div>
</div>

<script>
    // Функция для выбора картинки
    $('input[name="<?=$var_name?>"]').change(function(){
        var num = this.value;
        sel(num);
    });

    $('.div-class').click(function(){
        var num = $(this).attr('value');
        sel(num);
    });

    function sel( num ) {
        //$('#layer1').html('<img src="/_altar/1/alt_type/altar'+type+'_'+num+'.png" id="layer-img" class="front">');
        $('.img-view').removeClass('img-select');
        var imgName = 'img' + num;
        $('#' + imgName).addClass('img-select');
        $('input[value="'+num+'"]').prop('checked', 'checked');

        history.pushState('', '', '/partition/color_catalog?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog='+num);
        $('.next_step').attr('href','/partition/footer?type=<?=$_GET['type']?>&color=<?=$_GET['color']?>&color_catalog='+num);
    }
</script>
