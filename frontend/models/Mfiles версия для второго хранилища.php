<?php
//http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/relationships/104/916/latest
//http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/relationships/104/916/latest
//http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/relationships/104/916/latest
//http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/relationships/104/916/latest
//http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/relationships/104/916/latest


namespace frontend\models;

use Yii;

//use yii\base\Model;

class Mfiles
{


    public $debug = false;


    public $login = 'oren';
    public $pass = '3359100';
    public $extantion = 'txt';


    const Uninitialized = 0;
    const Text = 1;
    const Integer = 2;
    const Floating = 3;
    const Date = 5;
    const Time = 6;
    const Timestamp = 7;
    const Boolean = 8;
    const Lookup = 9;
    const MultiSelectLookup = 10;
    const Integer64 = 11;
    const FILETIME = 12;
    const MultiLineText = 13;
    const ACL = 14;

//$url = 'http://mfiles.lavi.co.il/REST/views/items';
//return_json_array_by_get_request($url);
// эта показывает корень пректа


//$url = 'http://mfiles.lavi.co.il/REST/objects/0/136150/latest/files';
//return_json_array_by_get_request($url);
// какйто документ метаданые выловил по этой ссылке
// в том числе его  [FileGUID] => {2C5C856D-61BF-470D-968B-79E7ABCA969E}
    /**
     * [Name] => ???? ?????? ???? ???????
     * [EscapedName] => ???? ?????? ???? ???????.docx
     * [Extension] => docx
     * [Size] => 40156
     * [LastModified] => 2016-07-03T14:12:57Z
     * [ChangeTimeUtc] => 2016-07-03T14:12:57Z
     * [ChangeTime] => 2016-07-03T14:12:57Z
     * [CreatedUtc] => 2015-12-13T07:02:23Z
     * [CreatedDisplayValue] => 12/13/2015 7:02 AM
     * [LastModifiedDisplayValue] => 7/3/2016 2:12 PM
     * [FileGUID] => {5832FFAF-5A77-4C7A-9B4E-6246C23D34EC}
     * [ID] => 137725
     * [Version] => 24
     */


    /*
    $url = 'http://mfiles.lavi.co.il/REST/views/V414/L22/L261/items.aspx';
    // показывает всю директорию КСТАТИ ЭТО НАША ДИРЕКОРИЯ ЖДЛЯ ТЕСТОВ
    return_json_array_by_get_request($url);
    exit;*/

    /*$url = 'http://mfiles.lavi.co.il/REST/views/V414/L22/L261/folders.aspx?limit=500&skipViewPathInfo=true';
    return_json_array_by_get_request($url);
    // последние две идентичные
    exit;*/


//
//$url = 'http://mfiles.lavi.co.il/REST/REST/views/V123/TMFWA&2520%252F%2520MFWS/items.aspx';
// ссылку подмотрел вебинтерфесе
// выдает бинарник
//$url = 'http://mfiles.lavi.co.il/REST/objects/0/160164/1/files/4AD72853-4B54-4106-9885-29A46116A03F/content.aspx';
////$url = 'http://mfiles.lavi.co.il/link.ashx?Action=Download&vault=F9930A12-4EE5-473F-A871-CADEE360639E&objectGUID=4AD72853-4B54-4106-9885-29A46116A03F&fileGUID=28717AF6-93D4-4329-AC0C-88FC0F0EB79B&ObjectVersion=-1';
//return_binary_by_get_request($url);

//exit;


//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
    public function return_binary_by_get_request($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);s
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-type: image/jpeg',
//    'ContentType: application/json',
//    'dataType: json',
            'X-Authentication: ' . $this->getAuthToken(),
        ));

        $output_2 = curl_exec($ch);
        curl_close($ch);
        header('Content-type: image/jpeg');
        header('Content-length: ' . strlen($output_2));
        header('Content-Disposition: attachment; filename="downloaded . jpg"');
        echo $output_2;

    }

    public function return_json_array_by_get_request($url)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-type: application/json',
//    'ContentType: application/json',
//    'dataType: json',
            'X-Authentication: ' . $this->getAuthToken(),
            'X-Extensions: MFWA',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Requested-With: XMLHttpRequest',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
        ));

        $output_2 = curl_exec($ch);
        $a = json_decode($output_2, true);
        if ($this->debug) print_r($a);
        curl_close($ch);

    }


    public function createPropertyValue($propertyDef, $typeDef, $value)
    {
        switch ($typeDef) {
            case self::Lookup :
                if ($value != NULL) {
                    return ['PropertyDef' => $propertyDef, 'TypedValue' => ['DataType' => $typeDef, 'Lookup' => ['Item' => $value, "DisplayValue" => '???? ???? - ??????']]];
                } else {
                    return [
                        'PropertyDef' => $propertyDef, 'TypedValue' => ['DataType' => $typeDef], 'HasValue' => false,
                    ];
                }
//        case MultiSelectLookup :
//            def lookups = []
//                value . each {
//            lookup ->
//                    lookups = lookups . plus([Item : lookup])
//                }
//                return [PropertyDef : propertyDef, TypedValue : [DataType : typeDef, Lookups : lookups]]
            default :
                return ['PropertyDef' => $propertyDef, 'TypedValue' => ['DataType' => $typeDef, 'Value' => $value]];
        }
    }


    public function upload_file_by_name_in_folder($file_name, $file_content, $dir_name, $dir_id)
    {

        // ТРИ ЗАПРОСА
        // 1. Предварительный аплоуд, получаем временный ID файла и его размер в $response1
        // 2. Создаем Объект/Папка для хранения этого файла
        // 3. Запихиваем в созданный объект папку файл по его ID $response1


        $url = 'http://mfiles.lavi.co.il/REST/files';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla / 4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);
//      most importent curl assues @filed as file field
//    $post_array = json_encode([
//        "file" => base64_encode($message)
//    ]);
        // запихиваем контент
        //
        //
        //
        curl_setopt($ch, CURLOPT_POSTFIELDS, $file_content);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/octet-stream',
//    'ContentType: application/json',
//    'dataType: json',
            'X-Authentication: ' . $this->getAuthToken(),

        ));
        $response1 = curl_exec($ch);
        $response1 = json_decode($response1, true);
        if ($this->debug) print_r($response1);
        $file_size = $response1['Size'];

        //////////////////////////////////////////////////
        //////////////////////////////////////////////////
        //////////////////////////////////////////////////
        //////////////////////////////////////////////////
        //////////////////////////////////////////////////

//    //
//    $c = "{
//            \n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $file_name . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 1,\n                    \"DisplayValue\": \"\u05d4\u05e0\u05d3\u05e1\u05d4\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1011,\n            \"TypedValue\": {\n                \"DataType\": 10,\n                \"Lookups\": [\n                    {\n                        \"DisplayValue\": \"" . $dir_name . "\",\n                        \"Item\": " . $dir_id . "\n                    }\n                ],\n                \"HasValue\": true\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 18464,\n                    \"DisplayValue\": \"T16299 - \u05e4\u05d9\u05ea\u05d5\u05d7 \u05db\u05dc\u05d9 \u05de\u05db\u05d9\u05e8\u05d4 - \u05dc\u05d1\u05d9\u05d0\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 38,\n                    \"DisplayValue\": \"\u05d0\u05e8\u05d5\u05df \u05e7\u05d5\u05d3\u05e9\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
//
////    $c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $file_name . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 1,\n                    \"DisplayValue\": \"\u05d4\u05e0\u05d3\u05e1\u05d4\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 18464,\n                    \"DisplayValue\": \"T16299 - \u05e4\u05d9\u05ea\u05d5\u05d7 \u05db\u05dc\u05d9 \u05de\u05db\u05d9\u05e8\u05d4 - \u05dc\u05d1\u05d9\u05d0\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 38,\n                    \"DisplayValue\": \"\u05d0\u05e8\u05d5\u05df \u05e7\u05d5\u05d3\u05e9\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
//
//
////    $c = "{
////\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $file_name . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n
////
////
////{\n            \"PropertyDef\": 1083,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 261,\n                    \"DisplayValue\": \"\u05e4\u05d9\u05ea\u05d5\u05d7 \u05db\u05dc\u05d9 \u05de\u05db\u05d9\u05e8\u05d4\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
//
//
//    $url = 'http://mfiles.lavi.co.il/REST/objects/0.aspx?checkIn=false&_method=POST';
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_VERBOSE, 0);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $c);
//
//    // в курле была така шняга --data-binary
//    curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//        //'Content-type: application/octet-stream',
//        //    'ContentType: application/json',
//        //    'dataType: json',
//
//        'Content-Type: application/json; charset=UTF-8',
//        'Accept: application/json, text/javascript, */*; q=0.01',
//        'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
//        'X-Requested-With: XMLHttpRequest',
//        'X-Extensions: MFWA',
//        'X-Authentication: ' . $this->getAuthToken(),
//    ));
//    $response2 = curl_exec($ch);
//    $response2 = json_decode($response2, true);

        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        if (!isset($response1['ObjVer']['ID']) AND $this->debug) echo('Не могу получить ID объекта может это важно ?');
        $c = "[\n    {\n        \"UploadID\": " . $response1['UploadID'] . ",\n        \"Title\": \"" . $file_name . "\",\n        \"Extension\": \"" . $this->extantion . "\",\n        \"Size\": " . $file_size . ",\n        \"TempFilePath\": null\n    }\n]";

        $url = 'http://mfiles.lavi.co.il/REST/objects/0/' . $dir_id . '/1/files/upload.aspx?_method=POST';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $c);

        // в курле была така шняга --data-binary
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //'Content-type: application/octet-stream',
            //    'ContentType: application/json',
            //    'dataType: json',

            'Content-Type: application/json; charset=UTF-8',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
            'X-Requested-With: XMLHttpRequest',
            'X-Extensions: MFWA',
            'X-Authentication: ' . $this->getAuthToken(),
        ));
        $response3 = curl_exec($ch);
        if ($this->debug) print_r(json_decode($response3, true));
//return $response2['ObjVer']['ID'];
        return $dir_id;
    }

    public function create_green_directory($name)
    {
        // чтобы найти этот запрос - выбери фильтр в запросах с ноликом в имени файлов 0.aspx
        // в этом запросе скорей всего через название материснкой папки дает понять куда нам грущить
        // ГРУЗИМ
        // ГРУЗИМ
        // ГРУЗИМ
        // ГРУЗИМ
        // ГРУЗИМ
        // ГРУЗИМ
        // ГРУЗИМ
        $c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $name . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 1,\n                    \"DisplayValue\": \"\u05d4\u05e0\u05d3\u05e1\u05d4\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 18464,\n                    \"DisplayValue\": \"T16299 - \u05e4\u05d9\u05ea\u05d5\u05d7 \u05db\u05dc\u05d9 \u05de\u05db\u05d9\u05e8\u05d4 - \u05dc\u05d1\u05d9\u05d0\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 38,\n                    \"DisplayValue\": \"\u05d0\u05e8\u05d5\u05df \u05e7\u05d5\u05d3\u05e9\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
        $url = 'http://mfiles.lavi.co.il/REST/objects/0.aspx?checkIn=false&_method=POST';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $c);

        // в курле была така шняга --data-binary
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //'Content-type: application/octet-stream',
            //    'ContentType: application/json',
            //    'dataType: json',

            'Content-Type: application/json; charset=UTF-8',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
            'X-Requested-With: XMLHttpRequest',
            'X-Extensions: MFWA',
            'X-Authentication: ' . $this->getAuthToken(),
        ));
        $response1 = curl_exec($ch);
        $response1 = json_decode($response1, true);
        if ($this->debug) print_r($response1);

//    /*///////////////////////////////////////////////////////////////////
//    ///////////////////////////////////////////////////////////////////
//    ///////////////////////////////////////////////////////////////////
//    ///////////////////////////////////////////////////////////////////
//    ///////////////////////////////////////////////////////////////////
//    ///////////////////////////////////////////////////////////////////
//    echo "<br> снимаем галочку возле иконки - ВЕРНУТЬ вместо ИЗЪЯТЬ иначе доступа у других к ней нет ";
//
//    $url = 'http://mfiles.lavi.co.il/REST/objects/0/' . $response1['ObjVer']['ID'] . '/latest.aspx';
//    $c = "{\n    \"Authentication\": null,\n    \"ESignResponses\": null\n}";
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_VERBOSE, 0);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
//    // GET !!!!!!!!!!!!!!
//    // GET !!!!!!!!!!!!!!
//    // GET !!!!!!!!!!!!!!
//    // GET !!!!!!!!!!!!!!
//    // GET !!!!!!!!!!!!!!
////    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $c);
//
//    // в курле была така шняга --data-binary
//    curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//        //'Content-type: application/octet-stream',
//        //    'ContentType: application/json',
//        //    'dataType: json',
//
//        'Content-Type: application/json; charset=UTF-8',
//        'Accept: application/json, text/javascript, */*; q=0.01',
//        'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
//        'X-Requested-With: XMLHttpRequest',
//        'X-Extensions: MFWA',
//        'X-Authentication: ' . $this->getAuthToken(),
//    ));
//    $response2 = curl_exec($ch);
//    $response2 = json_decode($response2, true);
//    print_r($response2);
//
//
//    $url = 'http://mfiles.lavi.co.il/REST/objects/0/' . $response1['ObjVer']['ID'] . '/2/signedcheckin.aspx?_method=PUT';
//    $c = "{\n    \"Authentication\": null,\n    \"ESignResponses\": null\n}";
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_VERBOSE, 0);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $c);
//
//    // в курле была така шняга --data-binary
//    curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//        //'Content-type: application/octet-stream',
//        //    'ContentType: application/json',
//        //    'dataType: json',
//
//        'Content-Type: application/json; charset=UTF-8',
//        'Accept: application/json, text/javascript, */*; q=0.01',
//        'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
//        'X-Requested-With: XMLHttpRequest',
//        'X-Extensions: MFWA',
//        'X-Authentication: ' . $this->getAuthToken(),
//    ));
//    $response3 = curl_exec($ch);
//    $response3 = json_decode($response3, true);
//    print_r($response3);*/

        return $response1['ObjVer']['ID'];

    }

    public function access4all_green_directory($id)
    {
        //читаем текущую версиб папки
        $url = 'http://mfiles.lavi.co.il/REST/objects/0/' . $id . '/latest.aspx';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
// GET!!!
// GET!!!
// GET!!!
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $c);
        curl_setopt($ch, CURLOPT_URL, $url);

        // в курле была така шняга --data-binary
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //'Content-type: application/octet-stream',
            //    'ContentType: application/json',
            //    'dataType: json',

            'Content-Type: application/json; charset=UTF-8',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
            'X-Requested-With: XMLHttpRequest',
            'X-Extensions: MFWA',
            'X-Authentication: ' . $this->getAuthToken(),
        ));
        $response1 = curl_exec($ch);
        $response1 = json_decode($response1, true);
        //print_r($response1);
        $version = $response1['ObjVer']['Version'];

        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        $url = 'http://mfiles.lavi.co.il/REST/objects/0/' . $id . '/' . $version . '/signedcheckin.aspx?_method=PUT';
        $c = "{\n    \"Authentication\": null,\n    \"ESignResponses\": null\n}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $c);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        // в курле была така шняга --data-binary
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //'Content-type: application/octet-stream',
            //    'ContentType: application/json',
            //    'dataType: json',

            'Content-Type: application/json; charset=UTF-8',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
            'X-Requested-With: XMLHttpRequest',
            'X-Extensions: MFWA',
            'X-Authentication: ' . $this->getAuthToken(),
        ));
        $response2 = curl_exec($ch);
        $response2 = json_decode($response2, true);
        if ($this->debug) print_r($response2);

//
//    $url = 'http://mfiles.lavi.co.il/REST/objects/0/' . $response1['ObjVer']['ID'] . '/2/signedcheckin.aspx?_method=PUT';
//    $c = "{\n    \"Authentication\": null,\n    \"ESignResponses\": null\n}";
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_VERBOSE, 0);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $c);
//
//    // в курле была така шняга --data-binary
//    curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//        //'Content-type: application/octet-stream',
//        //    'ContentType: application/json',
//        //    'dataType: json',
//
//        'Content-Type: application/json; charset=UTF-8',
//        'Accept: application/json, text/javascript, */*; q=0.01',
//        'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
//        'X-Requested-With: XMLHttpRequest',
//        'X-Extensions: MFWA',
//        'X-Authentication: ' . $this->getAuthToken(),
//    ));
//    $response3 = curl_exec($ch);
//    $response3 = json_decode($response3, true);
//    print_r($response3);
//
//    return $response1['ObjVer']['ID'];

    }

    public function getAuthToken()
    {
        $params = array(
            "Username" => $this->login,
            "Password" => $this->pass,
            "WindowsUser" => false,
        );

        $postData = json_encode($params);
        $url = 'http://mfiles.lavi.co.il/REST/server/authenticationtokens';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// НЕ ОТКЛЮЧАТЬ - не увидишь куки в хидере
//curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'ContentType: application/json',
            'dataType: json',
        ));

// мы авторизовались??
        $output_2 = curl_exec($ch);
        $a = json_decode($output_2, true);
        curl_close($ch);

        if (isset($a['Value'])) {
            // если Vault не указан читаем корневой и получаем его токен и UID
            $url = 'http://mfiles.lavi.co.il/REST/server/vaults';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-type: application/json',
//    'ContentType: application/json',
//    'dataType: json',
                'X-Authentication: ' . $a['Value'],
            ));

            /**
             * (
             * [0] => Array
             * (
             * [Name] => Lavi
             * [GUID] => {F9930A12-4EE5-473F-A871-CADEE360639E}
             * [Authentication] => dnrEv-Z4IdRNCRDzLRJY_jVxuFksFnc_Wu2tBJxaXNCFdGuPN1unB8-bMcopn_8wVZrrG3BOM2azSApbJ0fgNN0ZwY48ROzAZlpvxMV-tXxX5dTP8EBXN9wShkIiyY4hUmdJomSbpKyz-B4Xb-ZLsA8bsrtCWQlCSYFBoCu91EBVtR6y86DegfjxMWvyDbYDQvxrM-Ux9ugA0HLXP8C0fqkEnH4xai0M9Q2S8cFDC1cbn5SFlTb0BrN7kXCk04m6gv8G1s6QCBHT66FhpX6UvMp1uua117T4do1xVdr0bcoEs2jFZxX9OyRW2DF0_VUKPBSZoPEbKnaVtwoZEXGtWQ
             * )
             */
            $output_2 = curl_exec($ch);
            $a = json_decode($output_2, true);
//        print_r($a);
            curl_close($ch);
            if (isset($a['0']['Authentication'])) {
                return $a['0']['Authentication'];
            } else {
                echo "Authentification SET 2 Error! No Vaults ID";
            }
        } else {
            echo "Authentification SET 1 Error! No Token";
        }
    }


// список названий и матрица значений
    public function generateExcellContent($name_list, $values)
    {


        include_once("../../vendor/novikov/phpexcel/Classes/PHPExcel.php");
        $objPHPExcel = new \PHPExcel();
        $sheet = 0;
        $objPHPExcel->setActiveSheetIndex($sheet);


        /*    // выставляем ширину колонки == 10 точек ГОРИЗОНТАЛЬНАЯ ВЕКТОР таблицы
        $j = -1;
        for ($char = 'A'; $char !== 'ZZ'; $char++) {
            $j++;
            if ($j > sizeof($name_list)) break;
            //echo $char . ', '; //A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z, AA, AB,
            $objPHPExcel->getActiveSheet()->getColumnDimension($char)->setWidth(10);
        }*/

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(60);


        $objPHPExcel->getActiveSheet()
            ->setTitle('MAIN');


        // добавляем значение 1 бю строку файла ЗАГОЛОВОК
        /* // ГОРИЗОНТАЛЬНАЯ ВЕКТОР таблицы

       $j = -1;
       for ($char = 'A'; $char !== 'ZZ'; $char++) {
           $j++;
           if ($j > sizeof($name_list)) break;
           //echo $char . ', '; //A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z, AA, AB,
           $objPHPExcel->setCellValue($char . '1', $name_list[$j]);
       }*/

        // вертикальный ВЕКТОР таблицы

        $objPHPExcel->getActiveSheet()->setCellValue('A1', date('Y-m-d H:i:s'));


        foreach ($name_list as $k => $row) {

            $objPHPExcel->getActiveSheet()->setCellValue('A' . ($k + 2), $row);
        }


        foreach ($values as $k => $row) {
            //
            $objPHPExcel->getActiveSheet()->setCellValue('B' . ($k + 2), $row);
        }


//    header('Content-Type: application/vnd.ms-excel');
        $filename = "../../_result.xml.cache/Export_lavi_googlegorm_" . date("d-m-Y-H-i") . ".xls";
//    header('Content-Disposition: attachment;filename=' . $filename . ' ');
//    header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//    $objWriter->save('php://output');
        $objWriter->save($filename);

        return $filename;


    }


}
