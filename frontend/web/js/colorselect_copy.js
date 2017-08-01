var CONST_FIELD_TYPE = 'color_type_';
var CONST_LAYER_ID = '#generalBG';
var CONST_COLOR_CONTAINER = '#colorContainer';
var CONST_CLASS_LAYER = '.layer';

id = getParameterByName('id');
if (!id) {
    id = 1;
}


$(document).ready(function () {
    var options = getOptions(id);
});


$('.colors .btnn').live('click', function () {
    $(this).parent().parent().find('li').removeClass('select');
    $(this).parent().addClass('select');

    var type = $(this).parents().parents().parents().attr('class')
    //var kitchen = $('.galleryDesigner ul.variants li.select').index() ? 1 : 2;
    var kitchen = id;
    /*var idColor = $(this).attr('id');
     var idColor = idColor.replace(/"tag/g, '');*/

    var cls = $(this).find('img').attr('class');
    var idColor = cls.replace(/tag/g, '');

    if (type && kitchen && idColor) {
        var idType = type.replace(/type/g, '');

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

    action = '/site/furniture-ajax?id=' + id;

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

    action = '/site/furniture-ajax?id=' + id;

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

    options = kitchenOptions(kitchen);//kitchen, type, idColor

    if (options['kitchen_' + kitchen]) {
        objKitchen = options['kitchen_' + kitchen];
        background = options['kitchen_' + kitchen].background;

        $(CONST_LAYER_ID).html('<img src="' + background + '" />');

        if (objKitchen['type' + type]) {
            section = objKitchen['type' + type];

            if (section['image' + idColor]) {
                imgObject = section['image' + idColor];
                $('#layer' + type).html('<img src="' + imgObject.layer + '" />')
            }
        }
    }
}

function generateTypeHtml(kitchenKey) {
    // kitchenKey = kitchenKey == 0 ? 1 : 2;

    $(CONST_COLOR_CONTAINER).html('');
    $(CONST_CLASS_LAYER).html('');

    var kitchen = kitchenOptions(kitchenKey);

    for (var i in kitchen) {
        // console.log(kitchenKey);

        if ('kitchen_' + kitchenKey == i) {

            //присваивание изображения слою background
            kitchenID = i;

            for (var type in kitchen[i]) {
                if (kitchen[i].background) {
                    var layerBG = kitchen[i].background;

                    $(CONST_LAYER_ID).html('<img src="' + layerBG + '" />');
                }

                if (type != 'background') {
                    if (kitchen[i][type]) {
                        var title = '';

                        if (type == 'type1') {
                            title = 'תַבְנִית';
                        }
                        else if (type == 'type2') {
                            title = 'בד';
                        }
                        else if (type == 'type3') {
                            title = 'עץ';
                        }
                        else if (type == 'type4') {
                            title = 'חוּט';
                        }

                        var html = '';
                        var html2 = '';

                        html += '<div class="' + type + '">';
                        html += '<div class ="typeheader"><h2>' + title + '</h2></div>';
                        html += '<ul>';

                        var idType = type.replace(/type/g, '');
                        if (idType)
                            $('#' + CONST_FIELD_TYPE + idType).val(0);

                        for (var imageKey in kitchen[i][type]) {
                            if (imageKey != 'title' && kitchen[i][type][imageKey]['color'] && kitchen[i][type][imageKey]['layer']) {
                                var num = imageKey.replace(/image/g, '');

                                if (num)
                                    html2 += '<li><div class="btnn"><img src="' + kitchen[i][type][imageKey]['color'] + '" class="tag' + num + '"/></div>' + num + '</li>';

                            }
                        }

                        //Cufon.refresh("h1");

                        if (html2) {
                            html += html2;
                            html += '</ul>';
                            html += '</div>';
                        } else {
                            html = '';
                        }

                        $(CONST_COLOR_CONTAINER).append(html);
                    }
                }
            }

            // break;
        }
    }
}

function setDefault(kitchenID) {
    $('.colors ul li:first-child').addClass('select');
    $('.colors ul li:first-child div').each(function () {
        var cls = $(this).find('img').attr('class');

        for (var i = 1; i < 5; i++) {
            var idColor = $('.type' + i).find('img:first').attr('class').replace(/tag/g, '');
            findColor(kitchenID, i, idColor);
            $('#' + CONST_FIELD_TYPE + i).val(idColor);
        }
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