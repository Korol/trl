<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Backend Lavi Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);


    $menuItems = [
        ['label' => 'Google Forms', 'url' => ['/googleforms']],
        ['label' => 'PhotoMarkup Gallery List', 'url' => ['/galleries-photomarkup']],
//        ['label' => 'Form', 'url' => ['/site/googleforms']],
//        ['label' => 'Photo gallery', 'url' => ['/site/photo']],
//        ['label' => 'Furniture',
//            'items' => [
//                ['label' => 'Chair #1', 'url' => ['/site/furniture?id=1']],
//                ['label' => 'Chair #2', 'url' => ['/site/furniture?id=2']],
//                ['label' => 'Chair #3', 'url' => ['/site/furniture?id=3']],
//                ['label' => 'Chair #4', 'url' => ['/site/furniture?id=4']],
//            ],
//        ]
        [
            'template' => '<a href="{url}" target="_blank">{label}</a>',
            'label' => 'Frontend',
            'url' => 'http://lavi.new-dating.com/',
        ],
    ];


    if (Yii::$app->user->isGuest) {
        //        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Lavi Company <?= date('Y') ?>, Israel</p>

        <p class="pull-right">Powered by <a href='http://appleshtein.co.il/'>Appleshtein</a></p>
    </div>
</footer>





<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
