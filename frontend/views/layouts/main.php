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
    <?php $this->head();

    if(Yii::$app->language=='he')
    { ?>
        <style>
            .nav > li > a {
                padding: 10px 8px;
            }
            
            .frame-bg {
                font-size: 14px;
            }
        </style>

    <?php }
?>
</head>
<body>
<?php $this->beginBody() ?>
<style>
	.dropdown-submenu.pull-left>.dropdown-menu{
  left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}
    
.dropdown-submenu.pull-left{
  float:none;}

.dropdown-submenu>.dropdown-menu{
  top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}

.dropdown-submenu>a:after{
  display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}

.dropdown-submenu:hover>.dropdown-menu{
  display:none;}

.dropdown-submenu:hover>a:after{
  border-left-color:#000000;}

.dropdown-submenu{
  position:relative;}
	</style>
<div class="wrap">

    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar nav-headline" role="navigation">
        <div class="container clear-padding">
            <div class="navbar-header navbar-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand nav-right-logo" href="/"><img src="/img/logo-head.png" alt=""></a>
            </div>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <div class="navigation-wrap">
                    <ul id="w1" class="navbar-nav nav frame-bg">
<!--                        <li class="dropdown"><a class="dropdown-toggle" href="/site/client#" data-toggle="dropdown"><?=Yii::t('common', 'Cabinets')?>
                            <b class="caret"></b></a>
                            <ul id="w3" class="dropdown-menu">
                                <li><a href="/cabinet/placement-0-0-0?type=1" tabindex="-1">Cabinet #1</a></li>
                                <li><a href="/cabinet/placement-0-0-0?type=2" tabindex="-1">Cabinet #2</a></li>
                                <li><a href="/cabinet/placement-0-0-0?type=3" tabindex="-1">Cabinet #3</a></li>
                                <li><a href="/cabinet/placement-0-0-0?type=4" tabindex="-1">Cabinet #4</a></li>
                                <li><a href="/cabinet/placement-0-0-0?type=5" tabindex="-1">Cabinet #5</a></li>
                                <li><a href="/cabinet/placement-0-0-0?type=6" tabindex="-1">Cabinet #6</a></li>
                                <li><a href="/cabinet/test" tabindex="-1">Test page</a></li>
                            </ul>
                        </li>-->
                        <li class="dropdown"><a class="dropdown-toggle" href="/site/client#" data-toggle="dropdown"><?=Yii::t('common', 'Altar')?>
                                <b class="caret"></b></a>
                            <ul id="w3" class="dropdown-menu">
                                <li><a href="/seats?type=1" tabindex="-1">דגם קלאסי</a></li>
                                <li><a href="/seats?type=2" tabindex="-1">דגם לדינו</a></li>
                                <li><a href="/seats?type=3" tabindex="-1">דגם גליל</a></li>
                                <li><a href="/seats?type=4" tabindex="-1">דגם ישיבתי</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">דגמים נוספים</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">ריהוט משלים</a></li>
                            </ul>
                        </li>
                        <li><a href="/cabinet/type/" onclick="alert('בתהליך בנייה'); return false;"><?=Yii::t('common', 'Cabinets')?></a></li>
                        <li class="dropdown"><a class="dropdown-toggle" href="/site/client#" data-toggle="dropdown"><?=Yii::t('common', 'Furniture')?>
                                <b class="caret"></b></a>
                            <ul id="w3" class="dropdown-menu">
                                <li><a href="/cabinet/type" tabindex="-1">ספריות</a></li>
                                <li><a href="/partition/" tabindex="-1">מחיצות ניידות</a></li>
                                <li><a href="/altar/type" tabindex="-1">ארון קודש דביר</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">ארון קודש שילה</a></li>
                                <li><a href="/site/furniture?id=1" tabindex="-1">כסאות אליהו</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">ספריות מחיצה</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">שולחנות קריאה</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">עמודי חזן</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">במות קריאה בתורה</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">פריטים משלימים</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">פריטים נוספים</a></li>
                                <li><a href="#" onclick="alert('בתהליך בנייה'); return false;" tabindex="-1">מחיצות קבועות</a></li>
                            </ul>
                        </li>
                        <li><a href="http://mfiles.tastylife.org.ua" target="_blank"><?=Yii::t('common', 'Marking photo')?></a></li>
                        <li><a href="/site/photo"><?=Yii::t('common', 'Shoot photo')?></a></li>
                        <li class="dropdown"><a class="dropdown-toggle" href="/site/client#" data-toggle="dropdown"><?=Yii::t('common', 'Forms')?>
                                <b class="caret"></b></a>
                            <ul id="w2" class="dropdown-menu">
                                <li class="dropdown-submenu"><a tabindex="-1" href="#">שאלונים כלליים</a>
                                    <ul class="dropdown-menu to_url_m">
                                        <li><a tabindex="-1" href="/googleforms/view?id=2">שאלון לוגיסטי</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=5">שאלון כללי ואומנות</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=36">שאלון כללי - מפגש ראשון</a></li>
                                        <li><a tabindex="-1" href="#" onclick="alert('בתהליך בנייה'); return false;">לפני יציאה להתקנה</a></li>
                                        <li><a tabindex="-1" href="#" onclick="alert('בתהליך בנייה'); return false;">שאלון למתקין בגמר התקנה</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=49">סקר שביעות רצון לקוחות</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a tabindex="-1" href="#">מפרטים</a>
                                    <ul class="dropdown-menu to_url_m">
                                        <li><a tabindex="-1" href="/googleforms/view?id=31">מפרט ארון קודש ליבה קלאסית</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=30">מפרט ארון קודש חדרון</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=43">מפרט ארון קודש כספת</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=33">מפרט בימה</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=37">מפרט בימת מורשת</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=34">מפרט שולחן קריאה</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=44">מפרט מחיצה ניידת</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=45">מפרט מחיצה קבועה</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=48">מפרט עמוד חזן</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=41">מפרט דלתות</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=42">מפרט כללי פריט מיוחד</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a tabindex="-1" href="#">סיכומי פגישות ושיחות עם לקוחות</a>
                                    <ul class="dropdown-menu to_url_m">
                                        <li><a tabindex="-1" href="/googleforms/view?id=36">שאלון כללי - מפגש ראשון</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=38">סיכום פגישה / שיחת טלפון</a></li>
                                        <li><a tabindex="-1" href="/googleforms/view?id=47">איסוף תקלות מהשטח</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="/site/client"><?=Yii::t('common', 'Select Client')?></a></li>

                        <!--                        <li>-->
<!--                            <form action="/site/logout" method="post">-->
<!--                                <input type="hidden" name="_csrf-frontend"-->
<!--                                       value="bDhwSDdVNi5bcx8sQyB8diYVIXpwY18dGmJHC3VgAn4HZ0A/Z2ZEeg==">-->
<!--                                <button type="submit" class="btn btn-link">--><?php //=Yii::t('common', 'Logout')?><!--</button>-->
<!--                            </form>-->
<!--                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
        //= Breadcrumbs::widget([
          //  'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        //])
        ?>

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('common', 'Lavi Company') ?> <?= date('Y') ?>, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="/en/">english</a> | <a href="/he/">עברי</a></p>

        <p class="pull-right"><a href="http://admin.lavi.new-dating.com/">Backend</a>. <?= Yii::t('common', 'Powered by') ?> <a href='http:/appleshtein.co.il/'>Appleshtein</a>
        </p>
    </div>
</footer>

<!--<pre>
<?php
/*print_r($_COOKIE);
*/?>
</pre>-->

<?php $this->endBody() ?>
</body>

<script>
	$('.dropdown-submenu').click(function(){
        var val=$(this).children('.dropdown-menu').css('display');

        if(val == 'block') {
          $(this).find('.dropdown-menu').css('display','none');
        }
        else {
          $(this).parent().find('.dropdown-menu').css('display','none');
          $(this).children('.dropdown-menu').css('display','block');

          //If not enough space in left, display the submenu in ... right
          var menu=$(this).parent().find("ul");
          var menupos=menu.offset();

          if ((menupos.left + menu.width()) + 30 > $(window).width()) {
            var newpos= - menu.width();
          } else {
            var newpos=$(this).parent().width();
          }
          menu.css({left:newpos});
        }

        return false;
});
    $('.to_url_m a').click(function(){
        if($(this).attr('href')!='#')
            location.href = $(this).attr('href');
    });

	</script>
</html>
Lavi Hosting 2017
<?php 

$this->endPage();
