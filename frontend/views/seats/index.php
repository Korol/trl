<?php

    $this->registerJsFile('/js/jquery-3.1.1.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', ['position' => \yii\web\View::POS_HEAD]);

    use yii\helpers\Html;

    $this->title = Yii::t('common', 'Seats');
    $this->params['breadcrumbs'][] = $this->title;

$cookies = Yii::$app->request->cookies;
$client_id = $cookies->getValue('dir_id_mfiles');
$client_name = $cookies->getValue('dir_name_mfiles');

$files = scandir('images/'.$type);
?>
<div class="site-signup">
    <h1 class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>

    <div class="row">
        <div class="col-lg-12">
            <div class="fotorama" id="mfotorama"
                 data-width="650"
                 data-height="650"
                 data-direction="rtl"
                 data-nav="thumbs">
             <? foreach ($files as $file)
                {
                    if($file=='.'||$file=='..')
                        continue;
                    ?>
                    <img src="/images/<?=$type.'/'.$file?>"  data-caption="<?=str_replace(['.jpg','.png'], "", $file)?>" class="img-view">
            <?  }
                ?>
            </div>
        </div>
        <!--<div class="ws_shadow"></div>-->
	</div>
</div>

<script>
    $('#mfotorama').on('fotorama:show', function (e, fotorama) {
        $('#type').val((fotorama.activeIndex + 1));
    });
</script>
