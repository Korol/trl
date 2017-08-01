<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

//    $this->view->registerJsFile('/js/colorselect_altar000.js', ['position' => \yii\web\View::POS_HEAD]);
//    $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = Yii::t('common', 'Type of cabinet');
    $this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .img-view {
        width: 650px;
        height: 650px;
    }
</style>

<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">

        <div class="col-lg-8">
            <div class="fotorama" id="mfotorama"
                 data-width="650"
                 data-height="650"
                 data-direction="rtl"
                 data-nav="thumbs">
                <img src="/_cabinet/1/bookcase/bookcase6_1_1.png"  data-caption="ספריה סגורה בחלקה העליון ופתוחה בחלקה התחתון מק׳׳ט ספ 4" class="img-view">
                <img src="/_cabinet/1/bookcase/bookcase5_1_1.png"  data-caption="ספריה סגורה סגורה בדלתות עליונות ותחתונות מק׳׳ט ספ 5" class="img-view">
                <img src="/_cabinet/1/bookcase/bookcase4_1_1.png"  data-caption="ספריה מדורגת סגורה בחלקה התחתון ופתוחה בחלקה העליון מק׳׳ט ספ 6" class="img-view">
                <img src="/_cabinet/1/bookcase/bookcase3_1_1.png"  data-caption="ספריה פתוחה  מק׳׳ט ספ 1" class="img-view">
                <img src="/_cabinet/1/bookcase/bookcase2_1_1.png"  data-caption="ספריה פתוחה בחלקה העליון וסגורה בחלקה התחתון מק׳׳ט ספ 2" class="img-view">
                <img src="/_cabinet/1/bookcase/bookcase1_1_1.png"  data-caption="ספריה סגורה בדלתות שלמות  מק׳׳ט ספ 3" class="img-view">
            </div>
        </div>

        <div class="col-lg-4" style="height: 650px;">
            <form method="POST" style="position: absolute;bottom: 0;">
                <input type="hidden" name="type" value="" id="type">
                <input type="submit" name="submit" value="Next step" class="btn btn-style-default">
            </form>
        </div>

        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>
    $('#mfotorama').on('fotorama:show', function (e, fotorama) {
        $('#type').val((fotorama.activeIndex + 1));
    });
</script>
