<?php
/* @var $this yii\web\View */
/* @var $client_name frontend\controllers\CatalogController */
/* @var $client_id frontend\controllers\CatalogController */
/* @var $client_catalog frontend\controllers\CatalogController */

use yii\helpers\Html;
$this->title = Yii::t('common', 'Client Order');
?>

<!--<h1 class="header-frame">--><?//= Yii::t('common', 'Сatalog for the Client'); ?><!--</h1>-->
<h4><b><?= Yii::t('common', 'Order for the Client'); ?>: <?= $client_name; ?></b></h4><br>

<style>
    .catalog-column{
        max-height: 700px;
        overflow-y: scroll;
    }
    .catalog-columns-wrap{
        margin: 20px 0;
    }
    .catalog-column h4.text-center{
        color: #000;
        margin-bottom: 20px;
    }
    .cci-title {
        color: #000;
    }
    .cci-img img{
        max-width: 100%;
    }
    .catalog-items-list,
    .client-order-list,
    .client-catalog-list{
        min-height: 285px;
        padding-left: 0;
    }
    .dnd-here{
        width: 100%;
        color: #000;
        text-wrap: none !important;
        text-align: center;
        margin-top: 190px;
    }
    .rm-itm{
        float: right;
    }
    .catalog-items-list .rm-itm,
    .client-catalog-list .rm-itm{
        display: none;
    }
    .client-order-list .rm-itm{
        display: block;
    }
</style>

<div class="row catalog-columns-wrap">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                <div class="thumbnail catalog-column">
                    <h4 class="text-center">
                        <?= Yii::t('common', 'Client Design'); ?>
                    </h4>
                    <?php if(!empty($catalog_items)): ?>
                    <ul class="catalog-items-list droptrue">
                        <?php foreach ($catalog_items as $cat_item): ?>
                        <li class="thumbnail catalog-column-item clearfix" data-itm="<?= $cat_item->id; ?>" data-type="design">
                            <button onclick="removeItem(<?= $cat_item->id; ?>);" class="btn btn-danger btn-xs rm-itm">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <span class="cci-title"><?= $cat_item->title; ?></span>
                            <span class="cci-img">
                                <?= (!empty($cat_item->files[0]))
                                    ? Html::img($cat_item->files[0]->url, ['alt' => $cat_item->title])
                                    : '';
                                ?>
                            </span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="thumbnail dnd-here">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail catalog-column">
                    <h4 class="text-center"><?= Yii::t('common', 'Client Catalog'); ?></h4>
                    <ul class="client-catalog-list droptrue">
                        <?php foreach ($client_catalog as $ccat_item): ?>
                            <?php if($ccat_item->catalogItem->active == 0) continue; ?>
                            <li class="thumbnail catalog-column-item clearfix" data-itm="<?= $ccat_item->catalog_item_id; ?>" data-type="catalog">
                                <button onclick="removeItem(<?= $ccat_item->catalog_item_id; ?>);" class="btn btn-danger btn-xs rm-itm">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                                <span class="cci-title"><?= $ccat_item->catalogItem->title; ?></span>
                                <span class="cci-img">
                                <?= (!empty($ccat_item->catalogItem->files[0]))
                                    ? Html::img($ccat_item->catalogItem->files[0]->url, ['alt' => $ccat_item->catalogItem->title])
                                    : '';
                                ?>
                            </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-1">
                <div class="thumbnail dnd-here">
                    <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail catalog-column">
                    <h4 class="text-center"><?= Yii::t('common', 'Client Order'); ?></h4>
                    <ul id="sortable3" class="client-order-list connectedSortable droptrue"></ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <button id="save_c_catalog" class="btn btn-success btn-lg"><?= Yii::t('common', 'Save Client Order'); ?></button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    $(function() {
        $( "ul.droptrue" ).sortable({
            connectWith: ".connectedSortable",
            remove: function(event, ui) {
                ui.item.clone().appendTo('#sortable3');
                $(this).sortable('cancel');
            }
        }).disableSelection();

        $('#save_c_catalog').click(function () {
            var itms = '';
            $('#sortable3 li').each(function () {
                itms = (itms !== '')
                    ? itms+','+$(this).data('itm')+':'+$(this).data('type')
                    : itms+$(this).data('itm')+':'+$(this).data('type');
            });
            if(itms !== ''){
                $.post(
                    '/order/save',
                    {
                        items: itms,
                        client_id: '<?= $client_id; ?>'
                    },
                    function (data) {
                        if(data*1 > 0){
                            alert('<?= Yii::t('common', 'Client Order was saved successfully!'); ?>');
                        }
                        else{
                            alert('<?= Yii::t('common', 'Saving error!'); ?>');
                        }
                    },
                    'text'
                );
            }
            else{
                alert('<?= Yii::t('common', 'Empty Client Order!'); ?>');
            }
        });
    });

    function removeItem(itm) {
        $('#sortable3 li').each(function () {
            if($(this).data('itm')*1 === itm*1){
                $(this).remove();
                return false;
            }
        });
    }
</script>