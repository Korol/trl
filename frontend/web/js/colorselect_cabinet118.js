var CONST_FIELD_TYPE = 'color_type_';
var CONST_LAYER_ID = '.generalBG';
var CONST_COLOR_CONTAINER = '#colorContainer';
var CONST_CLASS_LAYER = '.layer';


function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// количество секций - жтогруппа картинок шкафонв на этом этапе!!!!!!!!!!!!
var id = readCookie('numsections');


var CONST_AJAX_URL = '/cabinet/ajax-1-1-8?typecabinet=' + readCookie('typecabinet') + '&colorcabinet=' + readCookie('colorcabinet') + '&type_door=' + readCookie('type_door') + '&color_door=' + readCookie('color_door') + '&id=';


$(document).ready(function () {
    var options = getOptions(id);
});


$('.colors .btnn').live('click', function () {
    $(this).parent().parent().find('li').removeClass('select');
    $(this).parent().addClass('select');

    var type = $(this).parents().parents().parents().attr('class')
    //var kitchen = $('.galleryDesigner ul.variants li.select').index() ? 1 : 2;
    var kitchen = 1;
    /*var idColor = $(this).attr('id');
     var idColor = idColor.replace(/"tag/g, '');*/

    var cls = $(this).find('img').attr('class');
    var idColor = cls.replace(/tag/g, '');

    if (type && kitchen && idColor) {
        var idType = type.replace(/type/g, '');
        // сохранем значение в момент клика
        $('#' + CONST_FIELD_TYPE + idType).val(idColor);
        findColor(kitchen, idType, idColor);
    }
});


$(document).ready(function () {
    /* выбор цвета - генерация html типов*/
    generateTypeHtml(id);
    setDefault(id);

    /* страница калькулятора - выбор метода подбора мебели */
    $('.galleryDesigner ul.variants li').click(function () {
        if ($(this).index() != 1) {
            $('.galleryDesigner ul.variants > li').addClass('select');
            $('.galleryDesigner ul.variants > li:nth-child(' + ($(this).index() + 1) + ')').removeClass('select');
            $('.galleryDesigner ul.variants > li:nth-child(2)').removeClass('select');

            $('#kitchenmodel').val($(this).index() ? 2 : 1);

            generateTypeHtml($(this).index() ? 'kitchen_1' : 0);
            setDefault($(this).index() ? 2 : 1);

            //Cufon.refresh("h2");
        }
    });
});

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
function getOptions(id) {

    action = CONST_AJAX_URL + id;

    var data = '';

    $.ajax({
        url: '' + action,
        type: 'GET',
        //async: false,
        // typeData: 'json',
        data: {'action': 'get_colors'},
        async: true,
        success: function (response) {
            data = response;

        }
    });

    console.log(data);


    return data;

}

function kitchenOptions(id) {

    //var options = '1';

    //var location = document.location.toString().split('/');

    //if (location[3].indexOf('calc_online.php') + 1 || location[3].indexOf('color_3.php') + 1) {

    action = CONST_AJAX_URL + id;

    $.ajax({
        url: '' + action,
        type: 'GET',
        async: false,
        typeData: 'json',
        data: {'action': 'get_colors'},
        //async: true,
        success: function (response) {
            options = response;
            //console.log(options);
        }
    });

    //}
    //console.log(options);

    return options;

}

function findColor(kitchen, type, idColor) {

    kitchen = 1;
    //options = kitchenOptions(kitchen);//kitchen, type, idColor

    if (options['kitchen_' + kitchen]) {
        objKitchen = options['kitchen_' + kitchen];
        background = options['kitchen_' + kitchen].background;

        $(CONST_LAYER_ID).html('<img src="' + background + '" />');
        //$('#layer0').css("background-image", 'url("'+background+'")');
        //$('#layer0').html('<img src="' + background + '" />')


        if (objKitchen['type' + type]) {
            section = objKitchen['type' + type];
            if (section['image' + idColor]) {
                imgObject = section['image' + idColor];
                $('#layer' + type).html('<img src="' + imgObject.layer + '" />')
            }
        }
    }
}

function generateTypeHtml(id) {
    // id = id == 0 ? 1 : 2;

    $(CONST_COLOR_CONTAINER).html('');
    $(CONST_CLASS_LAYER).html('');

    var kitchen = kitchenOptions(id);


    // какие инструменты для выборки сбоку рисуем
    for (var i in kitchen) {
        // console.log(id);
        //присваивание изображения слою background
        kitchenID = i;

        for (var type in kitchen[i]) {
            if (kitchen[i].background) {
                var layerBG = kitchen[i].background;
                $(CONST_LAYER_ID).html('<img src="' + layerBG + '" />');
                //$('#layer0').css("background-image", 'url("'+layerBG+'")');
                //$('#layer0').html('<img src="' + background + '" />')
            }
        }
        //открыто плаитра



     // frieze
        type = 'type5'
        if (kitchen[i][type]) {
            var title = '';
            title = 'Frieze';
            var html = '';
            var html2 = '';
            html += '<div style="display: none;" class="' + type + '">';
            html += '<div class ="typeheader"><h2>' + title + '</h2></div>';
            html += '<ul>';
            var idType = type.replace(/type/g, '');
            if (idType)
            // сохранем значение в форме form нулевое
                $('#' + CONST_FIELD_TYPE + idType).val(0);
            for (var imageKey in kitchen[i][type]) {
                if (imageKey != 'title' && kitchen[i][type][imageKey]['color'] && kitchen[i][type][imageKey]['layer']) {
                    var num = imageKey.replace(/image/g, '');
                    if (num)
                        html2 += '<li><div class="btnn"><span id=mynum>' + num + '</span><img src="' + kitchen[i][type][imageKey]['color'] + '" class="tag' + num + '"/></div></li>';

                }
            }
            if (html2) {
                html += html2;
                html += '</ul>';
                html += '</div>';
            } else {
                html = '';
            }
            $(CONST_COLOR_CONTAINER).append(html);
        }



     // decor
        type = 'type7'
        if (kitchen[i][type]) {
            var title = '';
            title = 'אומנות על פסי הפרדה';
            var html = '';
            var html2 = '';
            html += '<div class="' + type + '">';
            html += '<div class ="typeheader"><h2>' + title + '</h2></div>';
            html += '<ul>';
            var idType = type.replace(/type/g, '');
            if (idType)
            // сохранем значение в форме form нулевое
                $('#' + CONST_FIELD_TYPE + idType).val(0);
            for (var imageKey in kitchen[i][type]) {
                if (imageKey != 'title' && kitchen[i][type][imageKey]['color'] && kitchen[i][type][imageKey]['layer']) {
                    var num = imageKey.replace(/image/g, '');
                    if (num)
                        html2 += '<li><div class="btnn"><span id=mynum>' + num + '</span><img src="' + kitchen[i][type][imageKey]['color'] + '" class="tag' + num + '"/></div></li>';

                }
            }
            if (html2) {
                html += html2;
                html += '</ul>';
                html += '</div>';
            } else {
                html = '';
            }
            $(CONST_COLOR_CONTAINER).append(html);
        }




        // плаитра шкафов - скрытая
        //какой список объектов выводим - тут второй - тип шакофов
        //НИХЕРА ТУТ НЕ ДАЕМ ВЫБРАТЬ!!! СТИЛЯМИ СКРЫВАЕМ!!!!!!!
        // ЕСЛИ ОТРУБИТЬ ЭТОТ БЛОК НЕ ВЫВОДИТСЯ СЛОИ - лень разбираться почему
        // навреное по нему скипты считают номер картинкили пр
        type = 'type3'
        if (kitchen[i][type]) {
            var title = '';
            //title = 'Type / Color';
            var html = '';
            var html2 = '';
            html += '<div style="display: none;" class="' + type + '">';
            html += '<div class ="typeheader"><h2>' + title + '</h2></div>';
            html += '<ul>';
            var idType = type.replace(/type/g, '');
            if (idType)
                $('#' + CONST_FIELD_TYPE + idType).val(0);
            for (var imageKey in kitchen[i][type]) {
                if (imageKey != 'title' && kitchen[i][type][imageKey]['color'] && kitchen[i][type][imageKey]['layer']) {
                    var num = imageKey.replace(/image/g, '');
                    if (num)
                        html2 += '<li><div class="btnn"><span id=mynum>' + num + '</span><img src="' + kitchen[i][type][imageKey]['color'] + '" class="tag' + num + '"/></div></li>';

                }
            }
            if (html2) {
                html += html2;
                html += '</ul>';
                html += '</div>';
            } else {
                html = '';
            }
            $(CONST_COLOR_CONTAINER).append(html);
        }


        // плаитра шкафов - скрытая
        //какой список объектов выводим - тут второй - тип шакофов
        //НИХЕРА ТУТ НЕ ДАЕМ ВЫБРАТЬ!!! СТИЛЯМИ СКРЫВАЕМ!!!!!!!
        // ЕСЛИ ОТРУБИТЬ ЭТОТ БЛОК НЕ ВЫВОДИТСЯ СЛОИ - лень разбираться почему
        // навреное по нему скипты считают номер картинкили пр
        type = 'type1'
        if (kitchen[i][type]) {
            var title = '';
            //title = 'Type / Color';
            var html = '';
            var html2 = '';
            html += '<div style="display: none;" class="' + type + '">';
            html += '<div class ="typeheader"><h2>' + title + '</h2></div>';
            html += '<ul>';
            var idType = type.replace(/type/g, '');
            if (idType)
                $('#' + CONST_FIELD_TYPE + idType).val(0);
            for (var imageKey in kitchen[i][type]) {
                if (imageKey != 'title' && kitchen[i][type][imageKey]['color'] && kitchen[i][type][imageKey]['layer']) {
                    var num = imageKey.replace(/image/g, '');
                    if (num)
                        html2 += '<li><div class="btnn"><span id=mynum>' + num + '</span><img src="' + kitchen[i][type][imageKey]['color'] + '" class="tag' + num + '"/></div></li>';

                }
            }
            if (html2) {
                html += html2;
                html += '</ul>';
                html += '</div>';
            } else {
                html = '';
            }
            $(CONST_COLOR_CONTAINER).append(html);
        }



        // break;
    }
}

function setDefault(kitchenID) {
    $('.colors ul li:first-child').addClass('select');
    $('.colors ul li:first-child div').each(function () {
        var cls = $(this).find('img').attr('class');

        //выводим выброчно помимо бэкраунда еще какуойто слой
        var i = 1; // типа набора
        var idColor = 1; //айди набора см на серх кнопках переключения (тупо порядоквы йномер из внутри группы сприсутсвующих)
        // уже были тут картинку выбирали??
        //alert(readCookie('imgnuminlistcabinet'));
        if (readCookie('imgnuminlist_colorcabinet')) {
            idColor = readCookie('imgnuminlist_colorcabinet');
        }
        findColor(kitchenID, i, idColor);
        $('#' + CONST_FIELD_TYPE + i).val(idColor);

  //выводим выброчно помимо бэкраунда еще какуойто слой
        var i = 3; // типа набора
        var idColor = 1; //айди набора см на серх кнопках переключения (тупо порядоквы йномер из внутри группы сприсутсвующих)
        // уже были тут картинку выбирали??
        //alert(readCookie('imgnuminlistcabinet'));
        if (readCookie('imgnuminlist_cornice')) {
            idColor = readCookie('imgnuminlist_cornice');

        }
        findColor(kitchenID, i, idColor);
        $('#' + CONST_FIELD_TYPE + i).val(idColor);



        // первую фриз корниз и бордюр
        // даже если еще не выбранные
        i = 5; // типа набора
        idColor = 1; //айди набора см на серх кнопках переключения (тупо порядоквы йномер из внутри группы сприсутсвующих)
        // уже были тут картинку выбирали??
        //alert(readCookie('imgnuminlistcabinet'));
        if (readCookie('imgnuminlist_frieze')) {
            idColor = readCookie('imgnuminlist_frieze');
        }
        findColor(kitchenID, i, idColor);
        $('#' + CONST_FIELD_TYPE + i).val(idColor);


        // первую фриз корниз и бордюр
        // даже если еще не выбранные
        i = 7; // типа набора
        idColor = 1; //айди набора см на серх кнопках переключения (тупо порядоквы йномер из внутри группы сприсутсвующих)
        // уже были тут картинку выбирали??
        //alert(readCookie('imgnuminlistcabinet'));
        if (readCookie('imgnuminlist_decor')) {
            idColor = readCookie('imgnuminlist_decor');
        }
        findColor(kitchenID, i, idColor);
        $('#' + CONST_FIELD_TYPE + i).val(idColor);



    });
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}