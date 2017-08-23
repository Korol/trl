<?php
/* @var $this yii\web\View */
/* @var $client_name frontend\controllers\CatalogController */
/* @var $client_id frontend\controllers\CatalogController */
/* @var $client_catalog frontend\controllers\CatalogController */

use yii\helpers\Html;
$this->title = Yii::t('common', 'Client Order');
?>

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
            <div class="col-md-3">
                <div class="thumbnail catalog-column">
                    <h4 class="text-center">
                        <?= Yii::t('common', 'Client Design'); ?>
                    </h4>
                    <ul class="catalog-items-list droptrue">
                    <?php if(!empty($catalog_items)): ?>
                        <?php foreach ($catalog_items as $cat_item): ?>
                        <li class="thumbnail catalog-column-item clearfix" data-itm="<?= $cat_item['ID']; ?>" data-img="<?= $cat_item['img']; ?>" data-type="design">
                            <button onclick="removeItem('<?= $cat_item['ID']; ?>');" class="btn btn-danger btn-xs rm-itm">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <span class="cci-title"><?= $cat_item['Name']; ?></span>
                            <span class="cci-img">
                                <?= (!empty($cat_item['img']))
                                    ? Html::img($cat_item['img'], ['alt' => $cat_item['Name'], 'id' => 'mfiles_' . $cat_item['ID']])
                                    : '';
                                ?>
                            </span>
                        </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </ul>
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
                            <li class="thumbnail catalog-column-item clearfix" data-itm="<?= $ccat_item->catalog_item_sku; ?>" data-type="catalog">
                                <button onclick="removeItem('<?= $ccat_item->catalog_item_sku; ?>');" class="btn btn-danger btn-xs rm-itm">
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
                ui.item.clone(true).appendTo('#sortable3');
                $(this).sortable('cancel');
            }
        }).disableSelection();

        // сохранение заказа в БД
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
                            $('#sortable3').html('');
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

        // показ карточки товара из каталога Клиента в модальном окне
//        $('ul.client-catalog-list > li.thumbnail').click(function(){
        $('ul.client-catalog-list > li.thumbnail > span.cci-img > img').click(function(){
            // скрываем сообщения
            $('#PM_info').removeClass('show');
            $('#PM_success').removeClass('show');
            $('#PM_error').removeClass('show');
            $('#PM_info').addClass('hide');
            $('#PM_success').addClass('hide');
            $('#PM_error').addClass('hide');
            // меняем кнопки сохранения
//            $('#PM_order_save').removeClass('show');
//            $('#PM_order_save').addClass('hide');
//            $('#PM_save').removeClass('hide');
//            $('#PM_save').addClass('show');
            // ставим readonly для name и sku
            $('#PM_name').attr('readonly', 'readonly');
            $('#PM_sku').attr('readonly', 'readonly');
            // скрываем поле Комментарий в форме
//            $('#PM_comment_area').removeClass('show');
//            $('#PM_comment_area').addClass('hide');
            // SKU продукта
//            var itemSku = $(this).data('itm');
            var itemSku = $(this).closest('li.thumbnail').data('itm');
            $.post(
                '/catalog/get-item',
                { sku: itemSku },
                function(data){
                    if(data.name !== ''){
                        $('#PM_type').val('catalog');
                        $('#PM_title').html(data.name);
                        $('#PM_name').val(data.name);
                        $('#PM_sku').val(data.sku);
                        $('#PM_specification').val(data.specification);
                        $('#PM_placement').val(data.placement);
                        $('#PM_comment').val(data.comment);
                        $('#PM_num_rows').val(data.num_rows); // new fields
                        $('#PM_num_seats').val(data.num_seats);
                        $('#PM_favorite').val(data.favorite);
                        $('#PM_total_num_seats').val(data.total_num_seats);
                        $('#PM_image_text').val(data.image_text);
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

        // показ карточки товара из M-files в модальном окне ( > span.cci-img > img)
        $('ul.catalog-items-list > li.thumbnail').click(function(){
            // скрываем сообщения
            $('#PM_info').removeClass('show');
            $('#PM_success').removeClass('show');
            $('#PM_error').removeClass('show');
            $('#PM_info').addClass('hide');
            $('#PM_success').addClass('hide');
            $('#PM_error').addClass('hide');
            // меняем кнопки сохранения
//            $('#PM_order_save').removeClass('show');
//            $('#PM_order_save').addClass('hide');
//            $('#PM_save').removeClass('hide');
//            $('#PM_save').addClass('show');
            // удаляем readonly для name и sku
            $('#PM_name').removeAttr('readonly');
            $('#PM_sku').removeAttr('readonly');
            // скрываем поле Комментарий в форме
//            $('#PM_comment_area').removeClass('show');
//            $('#PM_comment_area').addClass('hide');
            // идентификатор продукта
//            var itemImg = $(this).data('img');
            var itemImg = $(this).closest('li.thumbnail').data('img');
            $('#PM_image').attr('src', itemImg);
            $.post(
                '/catalog/get-mfiles-item',
                {
                    img: itemImg
                },
                function(data){
                    if(data.name !== ''){
                        // продукт уже добавлен в БД – заполняем форму
                        $('#PM_type').val('design');
                        $('#PM_new').val('0');
                        $('#PM_title').html(data.name);
                        $('#PM_name').val(data.name);
                        $('#PM_sku').val(data.sku);
                        $('#PM_specification').val(data.specification);
                        $('#PM_placement').val(data.placement);
                        $('#PM_comment').val(data.comment);
                        $('#PM_num_rows').val(data.num_rows); // new fields
                        $('#PM_num_seats').val(data.num_seats);
                        $('#PM_favorite').val(data.favorite);
                        $('#PM_total_num_seats').val(data.total_num_seats);
                        $('#PM_image_text').val(data.image_text);
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
                    else{
                        // продукта нет в БД – показываем чистую форму
                        $('#PM_type').val('design');
                        $('#PM_new').val('1');
                        $('#PM_name').val('');
                        $('#PM_sku').val('');
                        $('#PM_specification').val('');
                        $('#PM_placement').val('');
                        $('#PM_comment').val('');
                        $('#PM_num_rows').val(''); // new fields
                        $('#PM_num_seats').val('');
                        $('#PM_favorite').val('');
                        $('#PM_total_num_seats').val('');
                        $('#PM_image_text').val('');
                        $('#ProductModal').modal('show');
                    }
                },
                'json'
            );
        });

        // показ карточки товара из Заказа в модальном окне
//        $('ul.client-order-list > li.thumbnail').click(function(){
//            // скрываем сообщения
//            $('#PM_info').removeClass('show');
//            $('#PM_success').removeClass('show');
//            $('#PM_error').removeClass('show');
//            $('#PM_info').addClass('hide');
//            $('#PM_success').addClass('hide');
//            $('#PM_error').addClass('hide');
//            // меняем кнопки сохранения
//            $('#PM_save').removeClass('show');
//            $('#PM_save').addClass('hide');
//            $('#PM_order_save').removeClass('hide');
//            $('#PM_order_save').addClass('show');
//            // показываем поле Комментарий в форме
//            $('#PM_comment_area').removeClass('hide');
//            $('#PM_comment_area').addClass('show');
//            // определяем тип продукта
//            var itemType = $(this).data('type');
//
//            if(itemType === 'design') {
//                // это продукт из M-files
//                // ставим readonly для name и sku
//                $('#PM_name').attr('readonly', 'readonly');
//                $('#PM_sku').attr('readonly', 'readonly');
//                // идентификатор продукта
//                var itemImg = $(this).data('img');
//                $('#PM_image').attr('src', itemImg);
//                $.post(
//                    '/catalog/get-mfiles-item',
//                    {
//                        img: itemImg
//                    },
//                    function (data) {
//                        if (data.name !== '') {
//                            // продукт уже добавлен в БД – заполняем форму
//                            $('#PM_type').val('design');
//                            $('#PM_new').val('0');
//                            $('#PM_title').html(data.name);
//                            $('#PM_name').val(data.name);
//                            $('#PM_sku').val(data.sku);
//                            $('#PM_specification').val(data.specification);
//                            $('#PM_placement').val(data.placement);
//                            $('#PM_places_num').val(data.places_num);
//                            if (data.image !== '') {
//                                $('#PM_image').removeClass('hide');
//                                $('#PM_image').addClass('show');
//                                $('#PM_image').attr('src', data.image);
//                                $('#PM_image').attr('alt', data.name);
//                            }
//                            else {
//                                $('#PM_image').removeClass('show');
//                                $('#PM_image').addClass('hide');
//                                $('#PM_image').attr('src', '');
//                                $('#PM_image').attr('alt', '');
//                            }
//                            $('#ProductModal').modal('show');
//                        }
//                        else {
//                            // продукта нет в БД – показываем чистую форму
//                            $('#PM_type').val('design');
//                            $('#PM_new').val('1');
//                            $('#PM_name').val('');
//                            $('#PM_sku').val('');
//                            $('#PM_specification').val('');
//                            $('#PM_placement').val('');
//                            $('#PM_places_num').val('');
//                            $('#ProductModal').modal('show');
//                        }
//                    },
//                    'json'
//                );
//            }
//            else if(itemType === 'catalog'){
//                // это продукт из локального каталога
//                // SKU продукта
//                var itemSku = $(this).data('itm');
//                $.post(
//                    '/catalog/get-item',
//                    { sku: itemSku },
//                    function(data){
//                        if(data.name !== ''){
//                            $('#PM_type').val('catalog');
//                            $('#PM_title').html(data.name);
//                            $('#PM_name').val(data.name);
//                            $('#PM_sku').val(data.sku);
//                            $('#PM_specification').val(data.specification);
//                            $('#PM_placement').val(data.placement);
//                            $('#PM_places_num').val(data.places_num);
//                            if(data.image !== ''){
//                                $('#PM_image').removeClass('hide');
//                                $('#PM_image').addClass('show');
//                                $('#PM_image').attr('src', data.image);
//                                $('#PM_image').attr('alt', data.name);
//                            }
//                            else{
//                                $('#PM_image').removeClass('show');
//                                $('#PM_image').addClass('hide');
//                                $('#PM_image').attr('src', '');
//                                $('#PM_image').attr('alt', '');
//                            }
//                            $('#ProductModal').modal('show');
//                        }
//                    },
//                    'json'
//                );
//            }
//        });

        // сохраняем изменения в карточке товара
        $('#PM_save').click(function () {
            var pmName = $('#PM_name').val();
            var pmSpecification = $('#PM_specification').val();
            var pmPlacement = $('#PM_placement').val();
            var pmSku = $('#PM_sku').val();
            var pmType = $('#PM_type').val();
            var pmNew = $('#PM_new').val();
            var pmImage = $('#PM_image').attr('src');
            var pmComment = $('#PM_comment').val();
            var pmImageText = $('#PM_image_text').val(); // new fields
            var pmFavorite = $('#PM_favorite').val();
            var pmNumRows = $('#PM_num_rows').val();
            var pmNumSeats = $('#PM_num_seats').val();
            if(pmSku !== ''){
                $.post(
                    '/catalog/save-item',
                    {
                        name: pmName,
                        specification: pmSpecification,
                        placement: pmPlacement,
                        sku: pmSku,
                        type: pmType,
                        image: pmImage,
                        new: pmNew,
                        comment: pmComment,
                        num_rows: pmNumRows, // new fields
                        num_seats: pmNumSeats,
                        image_text: pmImageText,
                        favorite: pmFavorite
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

        // сохраняем изменения в сессии для оформления заказа
//        $('#PM_order_save').click(function () {
//            var pmName = $('#PM_name').val();
//            var pmSpecification = $('#PM_specification').val();
//            var pmPlacement = $('#PM_placement').val();
//            var pmPlacesNum = $('#PM_places_num').val();
//            var pmSku = $('#PM_sku').val();
//            var pmType = $('#PM_type').val();
//            var pmNew = $('#PM_new').val();
//            var pmComment = $('#PM_comment').val();
//            var pmImage = $('#PM_image').attr('src');
//            if(pmSku !== ''){
//                $.post(
//                    '/catalog/save-item-session',
//                    {
//                        name: pmName,
//                        specification: pmSpecification,
//                        placement: pmPlacement,
//                        places_num: pmPlacesNum,
//                        sku: pmSku,
//                        type: pmType,
//                        image: pmImage,
//                        new: pmNew,
//                        comment: pmComment
//                    },
//                    function(data){
//                        if(data*1 > 0){
//                            $('#PM_success').removeClass('hide');
//                            $('#PM_info').removeClass('hide');
//                            $('#PM_success').addClass('show');
//                            $('#PM_info').addClass('show');
//                        }
//                        else{
//                            $('#PM_error').removeClass('hide');
//                            $('#PM_info').removeClass('hide');
//                            $('#PM_error').addClass('show');
//                            $('#PM_info').addClass('show');
//                        }
//                    },
//                    'text'
//                );
//            }
//        });
    });

    // удаление элемента из колонки заказа
    function removeItem(itm) {
        $('#sortable3 li').each(function () {
            if($(this).data('itm') === itm){
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
                    <input type="hidden" name="pm_type" id="PM_type">
                    <input type="hidden" name="pm_new" id="PM_new">
                    <div class="form-group">
                        <label for="PM_sku"><?= Yii::t('common', 'SKU'); ?>:</label>
                        <input type="text" name="pm_sku" id="PM_sku" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="PM_name"><?= Yii::t('common', 'Name'); ?>:</label>
                        <input type="text" name="pm_name" id="PM_name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="PM_image_text"><?= Yii::t('common', 'Image text'); ?>:</label>
                        <input type="text" name="pm_image_text" id="PM_image_text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="PM_favorite"><?= Yii::t('common', 'Favorite'); ?>:</label>
                        <input type="text" name="pm_favorite" id="PM_favorite" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="PM_num_rows"><?= Yii::t('common', 'Number of rows'); ?>:</label>
                        <input type="text" name="pm_num_rows" id="PM_num_rows" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="PM_num_seats"><?= Yii::t('common', 'Number of seats'); ?>:</label>
                        <input type="text" name="pm_num_seats" id="PM_num_seats" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="PM_total_num_seats"><?= Yii::t('common', 'Total number of seats'); ?>:</label>
                        <input type="text" name="pm_total_num_seats" id="PM_total_num_seats" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="PM_specification"><?= Yii::t('common', 'Specification'); ?>:</label>
                        <input type="text" name="pm_specification" id="PM_specification" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="PM_placement"><?= Yii::t('common', 'Placement'); ?>:</label>
                        <input type="text" name="pm_placement" id="PM_placement" class="form-control">
                    </div>
                    <div class="form-group" id="PM_comment_area">
                        <label for="PM_comment"><?= Yii::t('common', 'Comment'); ?>:</label>
                        <textarea name="pm_comment" id="PM_comment" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="PM_info" class="hide">
                    <div id="PM_success" class="alert alert-success alert-dismissible hide" role="alert">
                        <strong>Success!</strong> All changes saved!
                    </div>
                    <div id="PM_error" class="alert alert-danger alert-dismissible hide" role="alert">
                        <strong>Error!</strong> Changes not saved!
                    </div>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="PM_save">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->