<?php
/* @var $this yii\web\View */
/* @var $catalogs frontend\controllers\CatalogController */
/* @var $catalogs_list frontend\controllers\CatalogController */
/* @var $id frontend\controllers\CatalogController */
/* @var $catalog_items frontend\controllers\CatalogController */
/* @var $client_name frontend\controllers\CatalogController */
/* @var $client_id frontend\controllers\CatalogController */
/* @var $client_catalog frontend\controllers\CatalogController */

use yii\helpers\Html;
?>

<!--<h1 class="header-frame">--><?//= Yii::t('common', 'Сatalog for the Client'); ?><!--</h1>-->
<h4><b><?= Yii::t('common', 'Сatalog for the Client'); ?>: <?= $client_name; ?></b></h4><br>
<div class="row">
    <div class="col-md-5">
    <?php if(!empty($catalogs_list)): ?>
        <form action="" method="get" name="catalogSelect" class="form-inline">
            <div class="form-group">
                <label for="catalog_id"><?= Yii::t('common', 'Select Catalog'); ?>: </label>
                <select class="form-control" name="id" id="catalog_id" onchange="document.catalogSelect.submit();">
                    <option value="0">-- <?= Yii::t('common', 'Select Catalog Here'); ?> --</option>
                <?php foreach ($catalogs_list as $cat_key => $cat_title): ?>
                    <?php
                    $cat_selected = ($id == $cat_key)
                        ? 'selected'
                        : '';
                    ?>
                    <option value="<?= $cat_key; ?>" <?= $cat_selected; ?>><?= $cat_title; ?></option>
                <?php endforeach; ?>
                </select>
            </div>
        </form>
    <?php endif; ?>
    </div>
</div>

<?php if(!empty($id)): ?>
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
    .catalog-items-list .rm-itm{
        display: none;
    }
    .client-catalog-list .rm-itm{
        display: block;
    }
</style>

<div class="row catalog-columns-wrap">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-4">
                <div class="thumbnail catalog-column">
                    <h4 class="text-center">
                        <?= (!empty($catalogs[$id]->title))
                            ? $catalogs[$id]->title
                            : Yii::t('common', 'Catalog Name');
                        ?>
                    </h4>
                    <?php if(!empty($catalog_items)): ?>
                    <ul class="catalog-items-list droptrue">
                        <?php foreach ($catalog_items as $cat_item): ?>
                        <li class="thumbnail catalog-column-item clearfix" data-itm="<?= $cat_item->id; ?>">
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
            <div class="col-md-3">
                <div class="thumbnail dnd-here">
                    <?= Yii::t('common', 'Drag and Drop'); ?> <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail catalog-column">
                    <h4 class="text-center"><?= Yii::t('common', 'Client Catalog'); ?></h4>
                    <ul id="sortable3" class="client-catalog-list connectedSortable droptrue">
                        <?php foreach ($client_catalog as $ccat_item): ?>
                            <?php if($ccat_item->catalogItem->active == 0) continue; ?>
                            <li class="thumbnail catalog-column-item clearfix" data-itm="<?= $ccat_item->catalog_item_id; ?>">
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
        </div>
    </div>
    <div class="col-md-2">
        <button id="save_c_catalog" class="btn btn-success btn-lg"><?= Yii::t('common', 'Save Client Catalog'); ?></button>
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
                    ? itms+','+$(this).data('itm')
                    : itms+$(this).data('itm');
            });
            if(itms !== ''){
                $.post(
                    '/catalog/save',
                    {
                        items: itms,
                        client_id: '<?= $client_id; ?>'
                    },
                    function (data) {
                        if(data*1 > 0){
                            alert('<?= Yii::t('common', 'Client Catalog was saved successfully!'); ?>');
                        }
                        else{
                            alert('<?= Yii::t('common', 'Saving error!'); ?>');
                        }
                    },
                    'text'
                );
            }
            else{
                alert('<?= Yii::t('common', 'Empty Client Catalog!'); ?>');
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
<?php endif; ?>