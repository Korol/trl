<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $item_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'List of marking photo')];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-signup">
    <h1  class="header-frame"><?= Html::encode($this->title) ?></h1>

    <h4><b><?= $client_name ?></b></h4>


    <style type="text/css" media="all">

        #imgdiv {
            border: 1px solid #c0c0c0;
        }

        #txt {
            padding: 20px 0;
            direction: RTL;
            unicode-bidi: embed;
        }

        .ui-dialog {
            top: 100px !important;
        }

        #jquery-script-menu {
            position: fixed;
            height: 90px;
            width: 100%;
            top: 0;
            left: 0;
            border-top: 5px solid #316594;
            background: #fff;
            -moz-box-shadow: 0 2px 3px 0px rgba(0, 0, 0, 0.16);
            -webkit-box-shadow: 0 2px 3px 0px rgba(0, 0, 0, 0.16);
            box-shadow: 0 2px 3px 0px rgba(0, 0, 0, 0.16);
            z-index: 999999;
            padding: 10px 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        .jquery-script-center {
            width: 960px;
            margin: 0 auto;
        }

        .jquery-script-center ul {
            width: 212px;
            float: left;
            line-height: 45px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .jquery-script-center a {
            text-decoration: none;
        }

        .jquery-script-ads {
            width: 728px;
            height: 90px;
            float: right;
        }

        .jquery-script-clear {
            clear: both;
            height: 0;
        }

        .marker {
            width: 27px;
            height: 40px;
            position: absolute;
            left: -13px;
            top: -35px;
            font-size: 12px;
            font-weight: bold;
            line-height: 25px;
            letter-spacing: -1px;
            text-align: center;
            color: #fff;
        }

        .marker.black {
            background: url(http://www.jqueryscript.net/demo/jQuery-Plugin-For-Adding-Notes-Markers-To-An-Image-imgNotes/css/marker_black.png);
        }

        table.gridtable {
            font-family: verdana, arial, sans-serif;
            font-size: 11px;
            color: #333333;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;
            width: 100%;
        }

        table.gridtable th {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
        }

        table.gridtable td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }
    </style>

    <!--Внимание, эти ресурсы пока оставим здесь с АБСОЛЮТНЫМИ ПУТЯМИ
    , т.к возможно этот хтмл будет использоваться отдельно от сайта-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" media="screen">
    <script type="text/javascript"
            src="http://www.jqueryscript.net/demo/jQuery-Plugin-For-Adding-Notes-Markers-To-An-Image-imgNotes/libs/jquery/jquery.js"></script>
    <script type="text/javascript"
            src="http://www.jqueryscript.net/demo/jQuery-Plugin-For-Adding-Notes-Markers-To-An-Image-imgNotes/libs/jquery/jquery-ui.js"></script>
    <script type="text/javascript"
            src="http://www.jqueryscript.net/demo/jQuery-Plugin-For-Adding-Notes-Markers-To-An-Image-imgNotes/libs/jquery.mousewheel.min.js"></script>
    <script type="text/javascript"
            src="http://www.jqueryscript.net/demo/jQuery-Plugin-For-Adding-Notes-Markers-To-An-Image-imgNotes/libs/imgViewer.js"></script>
    <script type="text/javascript"
            src="http://lavi.new-dating.com/js/imgNotes.js"></script>

    <div class="row">
        <div class="col-lg-8">

            <!--src="http://lavi.new-dating.com/_making_photos/<= $photo_id >.PNG"/-->
            <div id="imgdiv" style="text-align: center">
                <img id="image" width="100%"
                     src="http://lavi.new-dating.com/attachments/file/download?id=<?= $photo_id ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <button class="btn btn-style-default" id="toggleEdit"><?=Yii::t('common', 'Edit')?></button>
            <!--            <button id="export">All notes</button>-->
            <div id=txt></div>

            <p>
                <?php
                $params = '?limit=500&0_o=102&00_p0^=' . $client_name;
                $url = 'http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/_tempsearch' . $params;

                ?>

            <div class="form-group field-settings-value has-success">
<!--                <label class="control-label" for="settings-value">--><?//= Yii::t('common', 'Comments') ?><!--</label>-->
                <textarea id="comments-value" class="form-control" name="comments" rows="6"></textarea>

                <div class="help-block"></div>
            </div>

            <button class="btn btn-style-default" id="exportAjax"><?= Yii::t('common', 'Save to M-files') ?></button>
            </p>
            &nbsp;
            <p>

                <?= Yii::t('common', 'Result will be stored here in') ?> <a target="_blank"
                                                                            href="<?= $url ?>">M-Files</a>
            </p>


        </div>

        <script type="text/javascript">
            ;
            (function ($) {
                $(document).ready(function () {
                    var $img = $("#image").imgNotes();
                    $img.one("load", function () {
                        $img.imgNotes("import", [
                            //{x: "0.5", y: "0.5", note: "test test"}
                        ]);

                        //by Novikov
                        //by Novikov
                        //by Novikov
                        //by Novikov
                        var $table = $("<table/>").addClass("gridtable");
                        //var $img = $("#image").imgNotes();
                        var notes = $img.imgNotes('export');
                        //console.log(notes);
                        if (notes.length > 0)$table.append("<th><?=Yii::t('common', 'NOTE')?></th><th width='10'><?=Yii::t('common', 'ID')?></th>");
                        $.each(notes, function (index, item) {
                            $table.append("<tr><td>" + item.note + "</td><td>" + item.id + "</td></tr>");
                        });
                        $('#txt').html($table);
                        //////////////////////
                        //////////4х местах///
                        //////////////////////
                        //////////////////////
                        //////////////////////

                    });
                    var $toggle = $("#toggleEdit");
                    //
                    if ($img.imgNotes("option", "canEdit")) {
                        $toggle.text("<?=Yii::t('common', 'View')?>");
                    } else {
                        $toggle.text("<?=Yii::t('common', 'Edit')?>");
                    }
                    $toggle.on("click", function () {
                        var $this = $(this);
                        if ($this.text() == "<?=Yii::t('common', 'Edit')?>") {
                            $this.text("<?=Yii::t('common', 'View')?>");
                            $img.imgNotes("option", "canEdit", true);
                        } else {
                            $this.text('<?=Yii::t('common', 'Edit')?>');
                            $img.imgNotes('option', 'canEdit', false);
                        }
                    });
//                    var $export = $("#export");

                    var $export = $("#exportAjax");

//                    $export.on("click", function () {
//                        var $table = $("<table/>").addClass("gridtable");
//                        var notes = $img.imgNotes('export');
//                        $table.append("<th>X</th><th>Y</th><th>NOTE</th>");
//                        $.each(notes, function (index, item) {
//                            $table.append("<tr><td>" + item.x + "</td><td>" + item.y + "</td><td>" + item.note + "</td></tr>");
//                        });
//                        $('#txt').html($table);
//                    });
                    //by Novikov
                    $export.on("click", function () {
                        $img.imgNotes('upload', '/mfiles/markedphoto', '<?=$photo_id?>', '<?=$client_id?>', '<?=$client_name?>', $("#comments-value").val());
                    });
                });
            })(jQuery);
        </script>


    </div>


</div>
