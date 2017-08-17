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
use yii\helpers\Url;
$this->title = Yii::t('common', 'Client Catalog');
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
    #ProductModal{
        z-index: 10000;
        background: none;
        color: #000;
    }
    #PM_image{
        max-width: 100%;
        margin-bottom: 20px;
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
                    <ul class="catalog-items-list droptrue">
                    <?php if(!empty($catalog_items)): ?>
                        <?php foreach ($catalog_items as $cat_item): ?>
                        <li class="thumbnail catalog-column-item clearfix" data-itm="<?= $cat_item->sku; ?>">
                            <button onclick="removeItem(<?= $cat_item->id; ?>);" class="btn btn-danger btn-xs rm-itm">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <span class="cci-title"><?= $cat_item->name; ?></span>
                            <span class="cci-img">
                                <?= (!empty($cat_item->image))
                                    ? Html::img($cat_item->image, ['alt' => $cat_item->name])
                                    : '';
                                ?>
                            </span>
                        </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </ul>
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
                            <?php //if($ccat_item->catalogItem->active == 0) continue; ?>
                            <li class="thumbnail catalog-column-item clearfix" data-itm="<?= $ccat_item->catalog_item_sku; ?>">
                                <button onclick="removeItem(<?= $ccat_item->catalog_item_sku; ?>);" class="btn btn-danger btn-xs rm-itm">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                                <span class="cci-title"><?= $ccat_item->catalogItem->name; ?></span>
                                <span class="cci-img">
                                <?= (!empty($ccat_item->catalogItem->image))
                                    ? Html::img($ccat_item->catalogItem->image, ['alt' => $ccat_item->catalogItem->name])
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

        // сохраняем каталог клиента в бд
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

        // показ карточки товара в модальном окне
        $('li.thumbnail').click(function(){
            // скрываем сообщения
            $('#PM_info').removeClass('show');
            $('#PM_success').removeClass('show');
            $('#PM_error').removeClass('show');
            $('#PM_info').addClass('hide');
            $('#PM_success').addClass('hide');
            $('#PM_error').addClass('hide');
            // SKU продукта
            var itemSku = $(this).data('itm');
            $.post(
                '/catalog/get-item',
                { sku: itemSku },
                function(data){
                    if(data.name !== ''){
                        $('#PM_title').html(data.name);
                        $('#PM_name').val(data.name);
                        $('#PM_sku').val(data.sku);
                        $('#PM_specification').val(data.specification);
                        $('#PM_placement').val(data.placement);
                        $('#PM_places_num').val(data.places_num);
                        if(data.image !== ''){
                            $('#PM_image').removeClass('hide');
                            $('#PM_image').addClass('show');
                            $('#PM_image').attr('src', data.image);
                            $('#PM_image').attr('alt', data.name);
                        }
                        else{
                            $('#PM_image').removeClass('show');
                            $('#PM_image').addClass('hide');
                            $('#PM_image').attr('src', '');
                            $('#PM_image').attr('alt', '');
                        }
                        $('#ProductModal').modal('show');
                    }
                },
                'json'
            );
        });

        // сохраняем изменения в карточке товара
        $('#PM_save').click(function () {
            var pmSpecification = $('#PM_specification').val();
            var pmPlacement = $('#PM_placement').val();
            var pmPlacesNum = $('#PM_places_num').val();
            var pmSku = $('#PM_sku').val();
            var pmType = $('#PM_type').val();
            if(pmSku !== ''){
                $.post(
                    '/catalog/save-item',
                    {
                        specification: pmSpecification,
                        placement: pmPlacement,
                        places_num: pmPlacesNum,
                        sku: pmSku,
                        type: pmType
                    },
                    function(data){
                        if(data*1 > 0){
                            $('#PM_success').removeClass('hide');
                            $('#PM_info').removeClass('hide');
                            $('#PM_success').addClass('show');
                            $('#PM_info').addClass('show');
                        }
                        else{
                            $('#PM_error').removeClass('hide');
                            $('#PM_info').removeClass('hide');
                            $('#PM_error').addClass('show');
                            $('#PM_info').addClass('show');
                        }
                    },
                    'text'
                );
            }
        });
    });

    // удаление элемента из колонки каталога клиента
    function removeItem(itm) {
        $('#sortable3 li').each(function () {
            if($(this).data('itm')*1 === itm*1){
                $(this).remove();
                return false;
            }
        });
    }
</script>

<div id="ProductModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Product card: <span id="PM_title"></span></h4>
            </div>
            <div class="modal-body" id="PM_body">
                <div>
                    <img id="PM_image" src="" alt=""/>
                </div>
                <form action="/catalog/save-item-info" id="product_card_form" name="product_card_form">
                    <input type="hidden" name="pm_type" id="PM_type" value="catalog">
                    <div class="form-group">
                        <label for="PM_name">Name:</label>
                        <input type="text" name="pm_name" id="PM_name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="PM_sku">SKU:</label>
                        <input type="text" name="pm_sku" id="PM_sku" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="PM_specification">Specification:</label>
                        <input type="text" name="pm_specification" id="PM_specification" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="PM_placement">Placement:</label>
                        <input type="text" name="pm_placement" id="PM_placement" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="PM_places_num">Places num:</label>
                        <input type="text" name="pm_places_num" id="PM_places_num" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="PM_info" class="hide">
                    <div id="PM_success" class="alert alert-success alert-dismissible hide" role="alert">
                        <strong>Success!</strong> All changes saved!
                    </div>
                    <div id="PM_error" class="alert alert-danger alert-dismissible hide" role="alert">
                        <strong>Error!</strong> All changes not saved!
                    </div>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="PM_save">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>