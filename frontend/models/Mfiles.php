<?php

namespace frontend\models;

use Yii;

//use yii\base\Model;

class Mfiles
{

    public $debug = false;
    // папка с клиентами
    public $root_dir_path = 'V6914'; // из адреса вида http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/V6914/L12651/L8/L12
    // пользователь от которого скрипт работает в системе
    public $login = 'oren';
    public $pass = '3359100';
    // расширение файлов хранится отдельно для аплоуда
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


    //public function upload_file_in_multifolder_bClassname_byDropdwn4name_byDropdwn5name(
    public function upload_file_by_name_in_folder(
        $file_name, //имя PDF
        $file_content, //тупо контент
        $dir_id_pd1064, //внутренний ID mfiles клиента из куки
        $dir_name_pd1064, //название папки клиента mfiles клиента из куки
        $subdir_id, //??
        $subdir_name_pd0, //имя мультипапки
        //new
        $classname_multfolder_pd100 = '43',//'לביצוע', // соотве ади смотри в аяксе выпадающего меню формы
        $dropdwn_filed_pd1093 = '47',//'מכירות',
        $dropdwn_filed_pd1133 = '117' //ьтп мебели но в данном слкчае "Проект на всех уровнях"
    )
    {

        // кодируем в тфкой формат  \u05dc\u05d1\u05d9\u05e6\u05d5\u05e2
        // кодируем в тфкой формат  \u05dc\u05d1\u05d9\u05e6\u05d5\u05e2
        // кодируем в тфкой формат  \u05dc\u05d1\u05d9\u05e6\u05d5\u05e2
        $dir_name_pd1064 = trim(json_encode($dir_name_pd1064), '"');
        $file_name = trim(json_encode($file_name), '"');

//        $classname_multfolder_pd100 = trim(json_encode($classname_multfolder_pd100), '"');
//        $dropdwn_filed_pd1093 = trim(json_encode($dropdwn_filed_pd1093), '"');
//        $dropdwn_filed_pd1133 = trim(json_encode($dropdwn_filed_pd1133), '"');


        //  echo "$file_name, $file_content, $dir_id, $dir_name, $subdir_id, $subdir_name";


        //$c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"11111111111111\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 1,\n                    \"DisplayValue\": \"\u05d4\u05e0\u05d3\u05e1\u05d4\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1011,\n            \"TypedValue\": {\n                \"DataType\": 10,\n                \"Lookups\": [\n                    {\n                        \"DisplayValue\": \"11111111111111\",\n                        \"Item\": 164004\n                    }\n                ],\n                \"HasValue\": true\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 12727,\n                    \"DisplayValue\": \"1012 - \u05d4\u05d0\u05e9\u05db\u05e0\u05d6\u05d9 \u05d1\u05d9\u05ea \u05d0\u05dc \u05d0\' - \u05d1\u05d9\u05ea \u05d0\u05dc\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 38,\n                    \"DisplayValue\": \"\u05d0\u05e8\u05d5\u05df \u05e7\u05d5\u05d3\u05e9\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
        //$c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $subdir_name_pd0 . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 1,\n                    \"DisplayValue\": \"" . $classname_multfolder_pd100 . "\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1011,\n            \"TypedValue\": {\n                \"DataType\": 10,\n                \"Lookups\": [\n                    {\n                        \"DisplayValue\": \"" . $subdir_name_pd0 . "\",\n                        \"Item\": 164004\n                    }\n                ],\n                \"HasValue\": true\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": " . $dir_id_pd1064 . ",\n                    \"DisplayValue\": \"" . $dir_name_pd1064 . "\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 38,\n                    \"DisplayValue\": \"" . $dropdwn_filed_pd1093 . "\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
        //12/2016
        //$c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $subdir_name_pd0 . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n                                                   {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": " . $classname_multfolder_pd100 . ",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                   \"Item\": " . $dir_id_pd1064 . ",\n                    \"DisplayValue\": \"" . $dir_name_pd1064 . "\"\n               }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": \"" . $dropdwn_filed_pd1093 . "\",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1133,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": " . $dropdwn_filed_pd1133 . ",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}' --compressed\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 43,\n                    \"DisplayValue\": \"\u05dc\u05d1\u05d9\u05e6\u05d5\u05e2\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 11119,\n                    \"DisplayValue\": \"100 - \u05de\u05d3\u05d9\u05e7\u05dc \u05e1\u05e0\u05d8\u05e8 - \u05d4\u05e8\u05e6\u05dc\u05d9\u05d4\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 47,\n                    \"DisplayValue\": \"\u05de\u05db\u05d9\u05e8\u05d5\u05ea\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1133,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 117,\n                    \"DisplayValue\": \"\u05e8\u05de\u05ea \u05db\u05dc\u05dc \u05d4\u05e4\u05e8\u05d5\u05d9\u05d9\u05e7\u05d8\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
        $c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $subdir_name_pd0 . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n                                                   {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": " . $classname_multfolder_pd100 . ",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                   \"Item\": " . $dir_id_pd1064 . ",\n                    \"DisplayValue\": \"" . $dir_name_pd1064 . "\"\n               }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": \"" . $dropdwn_filed_pd1093 . "\",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1133,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": " . $dropdwn_filed_pd1133 . ",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";

        //12/2016  ORIGINAL curl 'http://mfiles.lavi.co.il/REST/objects/0.aspx?checkIn=false&_method=POST' -H 'X-Extensions: MFWA' -H 'Origin: http://mfiles.lavi.co.il' -H 'Accept-Encoding: gzip, deflate' -H 'Accept-Language: en,ru;q=0.8,en-US;q=0.6,uk;q=0.4,de;q=0.2,he;q=0.2' -H 'X-Requested-With: XMLHttpRequest' -H 'Cookie: ASP.NET_SessionId=qacep3zovulnlnylzhl1jibr; fileDownload=true; cardPositionSize=%7B%22Height%22%3A%22561.2px%22%2C%22Width%22%3A%22560px%22%2C%22PositionTop%22%3A11%2C%22PositionLeft%22%3A260%7D; History.Back=%23F9930A12-4EE5-473F-A871-CADEE360639E%2Fviews%2F_tempsearch%3Flimit%3D500%260_o%3D102%2600_p0%5E%3D100%20-%20%D7%9E%D7%93%D7%99%D7%A7%D7%9C%20%D7%A1%D7%A0%D7%98%D7%A8%20-%20%D7%94%D7%A8%D7%A6%D7%9C%D7%99%D7%94' -H 'Connection: keep-alive' -H 'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E' -H 'X-Timezone: 120' -H 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.28 Safari/537.36' -H 'Content-Type: application/json; charset=UTF-8' -H 'Accept: application/json, text/javascript, */*; q=0.01' -H 'Referer: http://mfiles.lavi.co.il/Default.aspx' -H 'DNT: 1' --data-binary $'{\n    "PropertyValues": [\n        {\n            "PropertyDef": 0,\n            "TypedValue": {\n                "DataType": 1,\n                "Value": "test",\n                "HasValue": true,\n                "IsMultiValue": false\n            },\n            "HasValue": true,\n            "IsAutomatic": false,\n            "IsClassAssociated": true\n        },\n        {\n            "PropertyDef": 39,\n            "TypedValue": {\n                "DataType": 9\n            },\n            "HasValue": false,\n            "IsAutomatic": false\n        },\n        {\n            "PropertyDef": 99,\n            "TypedValue": {\n                "DataType": 9\n            },\n            "HasValue": false,\n            "IsAutomatic": false\n        },\n        {\n            "PropertyDef": 100,\n            "TypedValue": {\n                "DataType": 9,\n                "Lookup": {\n                    "Item": 43,\n                    "DisplayValue": "\u05dc\u05d1\u05d9\u05e6\u05d5\u05e2"\n                }\n            },\n            "HasValue": true\n        },\n        {\n            "PropertyDef": 1064,\n            "TypedValue": {\n                "DataType": 9,\n                "Lookup": {\n                    "Item": 11119,\n                    "DisplayValue": "100 - \u05de\u05d3\u05d9\u05e7\u05dc \u05e1\u05e0\u05d8\u05e8 - \u05d4\u05e8\u05e6\u05dc\u05d9\u05d4"\n                }\n            },\n            "HasValue": true,\n            "IsAutomatic": false,\n            "IsClassAssociated": true\n        },\n        {\n            "PropertyDef": 1093,\n            "TypedValue": {\n                "DataType": 9,\n                "Lookup": {\n                    "Item": 47,\n                    "DisplayValue": "\u05de\u05db\u05d9\u05e8\u05d5\u05ea"\n                }\n            },\n            "HasValue": true,\n            "IsAutomatic": false,\n            "IsClassAssociated": true\n        },\n        {\n            "PropertyDef": 1133,\n            "TypedValue": {\n                "DataType": 9,\n                "Lookup": {\n                    "Item": 117,\n                    "DisplayValue": "\u05e8\u05de\u05ea \u05db\u05dc\u05dc \u05d4\u05e4\u05e8\u05d5\u05d9\u05d9\u05e7\u05d8"\n                }\n            },\n            "HasValue": true,\n            "IsAutomatic": false,\n            "IsClassAssociated": true\n        }\n    ],\n    "Workflow": null,\n    "TemplateForFiles": null,\n    "Files": null,\n    "NamedACL": -1,\n    "ACL": {\n        "IsUnSpecified": false,\n        "CheckedOutToUserID": -2147483648,\n        "HasCheckedOutToUserID": false,\n        "IsFullyAuthoritative": false,\n        "AutomaticComponents": [],\n        "CustomComponent": {\n            "AccessControlEntries": [\n                {\n                    "ChangePermissionsPermission": 1,\n                    "EditPermission": 1,\n                    "ReadPermission": 1,\n                    "DeletePermission": 1,\n                    "IsGroup": true,\n                    "UserOrGroupID": 1,\n                    "IsPsudoUser": false,\n                    "HasConcreteUserOrGruopID": true\n                }\n            ],\n            "CanDeactivate": false,\n            "CurrentUserBinding": -2147483648,\n            "HasCurrentUser": false,\n            "HasCurrentUserBinding": false,\n            "HasNamedACLLink": true,\n            "HasPseudoUsers": false,\n            "IsActive": true,\n            "NamedACLLink": -1\n        }\n    },\n    "IsBlankTemplate": false\n}' --compressed


        $url = 'http://mfiles.lavi.co.il/REST/objects/0.aspx?checkIn=false&_method=POST';
        if ($this->debug) {
            echo $c;
            echo $url;
        }

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
        $response0 = curl_exec($ch);
        $response0 = json_decode($response0, true);
        if ($this->debug) {
            print_r($response0);
            echo "===============END STEP 1 =================\n\n\n\n";

        }
        /**
         * На выходе
         * displayID":"164005"
         *
         */
        $displayID = $response0['DisplayID'];
        $this->access4all_green_directory($displayID);
//        $displayID = '3-743';

        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////


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
        if ($this->debug) {
            print_r($response1);
            echo "===============END STEP 2 ================= \n\n\n\n";
        }

        $file_size = $response1['Size'];
        $uploadID = $response1['UploadID'];
        /**
         * Возвращаем
         * "UploadID":4,
         *
         */
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////

        $c = "[\n    {\n        \"UploadID\": " . $response1['UploadID'] . ",\n        \"Title\": \"" . $file_name . "\",\n        \"Extension\": \"" . $this->extantion . "\",\n        \"Size\": " . $file_size . ",\n        \"TempFilePath\": null\n    }\n]";
        $c = "[\n    {\n        \"UploadID\": " . $uploadID . ",\n        \"Title\": \"" . $file_name . "\",\n        \"Extension\": \"" . $this->extantion . "\",\n        \"Size\": " . $file_size . ",\n        \"TempFilePath\": null\n    }\n]";
        $url = 'http://mfiles.lavi.co.il/REST/objects/0/' . $displayID . '/1/files/upload.aspx?_method=POST';
        //$url = 'http://mfiles.lavi.co.il/REST/objects/0/164005/1/files/upload.aspx?_method=POST';


        if ($this->debug) {
            echo $c;
            echo $url;
        }

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
        $response2 = curl_exec($ch);
        $response2 = json_decode($response2, true);
        if ($this->debug) {
            print_r($response2);
            echo "===============END STEP 3 ================= \n\n\n\n";
        }
        $this->access4all_green_directory($response2['AddedFiles'][0]['ID']);

//print_r($response2);
//        return $response2['AddedFiles'][0]['ID'];
        // важно для вмирвани яссылк помто на объъект в письме
        return trim($response2['ObjectGUID'], '{}');
    }


    /**
     *
     * $url = 'http://mfiles.lavi.co.il/REST/views/V6914/items.aspx';
     * возвращает список папок (mfiles_id, mfiles_name) в заданой в классе рутовой директории
     */
    public function reading_dir_by_path_json_array()
    {

        // как реадизовать пагинацию  - хер его знает
        //толко первых 200 выдает

        $url = 'http://mfiles.lavi.co.il/REST/views/' . trim($this->root_dir_path, '/ ') . '/items.aspx';
        //
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
        //if ($this->debug) print_r($a);
        curl_close($ch);
        $result = [];
        foreach ($a['Items'] as $row) {
            $result[] = [
                'id' => $row['PropertyFolder']['Lookup']['Item'],
                'name' => $row['PropertyFolder']['Lookup']['DisplayValue']
            ];
        }
        return $result;
    }

    public function search_in_dir_by_title_name($name)
    {


        $name = urlencode($name);
        // остановися на помленем вариент е- посик только папок класса КЛИЕНТ
        // но их содает заказсчик самочстоянтеьльно
        // скрипт не создает

        // содержит в  названии этот фрагмент
        $params = '?limit=500&00_p0*=' . $name; // не использую

        //  фрагмент в начале названия
        $params = '?limit=500&00_p0^=' . $name; // не использую

        // ищем только папки созданные киентом - я такие так и не научился создавать даже в ручну.!!!
        $params = '?limit=500&0_o=102&00_p0^=' . $name;
        // не все документы а только хранлище клиентов
        $url = 'http://mfiles.lavi.co.il/REST/views/_tempsearch/searchws.aspx' . $params;

        //echo "Result M-files <a href='http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/_tempsearch" . $params . "'>here</a>";


        //
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


//        print_r($a);
//        exit;
        curl_close($ch);

        if (isset($a['Items']['0'])) {
            foreach ($a['Items'] as $item) {
                $result_items[] = [
                    'id' => $item['ObjectVersion']['ObjVer']['ID'],
                    'name' => $item['ObjectVersion']['Title'],
                ];
            }
            $result = [
                'error' => false,
                'result' => $result_items,
            ];

        } else {

            $result = [
                'error' => true,
                'result' => [],
            ];

        }


        return $result;

    }


    /**
     * $url = 'http://mfiles.lavi.co.il/REST/views/V6914/items.aspx';
     * возвращает список папок (mfiles_id, mfiles_name) в заданой $url директории
     */
    public function get_or_create_clientdir_by_client_id________not_use_______($client_id)
    {
        if (!preg_match('/(\d+)/', $client_id, $d))
            die('Client name must be numeric');
        $client_id = $d[1];

        $list = $this->reading_dir_by_path_json_array();
        foreach ($list as $row) {
            if (preg_match('/^(\d+)/', $row['name'], $d))
                if ($d[1] == $client_id) return $row['id'];
        }
        // такого клиента нет создаем нового
        $dir_name_mfiles = $client_id . '_client';

        $dir_id_mfiles = $this->create_green_directory($dir_name_mfiles);
        // снимаем метку ТОЛЬКО Я с директории
        //            echo "<br>
        //снимаем галочку возле иконки - ВЕРНУТЬ вместо ИЗЪЯТЬ иначе доступа у других к ней нет $dir_id ";
        $this->access4all_green_directory($dir_id_mfiles);

        return $dir_id_mfiles;
    }


    /**
     * @param $file_name
     * @param $file_content
     * @param $dir_id
     * @return mixed
     */

    public function upload_file_by_name_in_folder_____________________($file_name, $file_content, $dir_id, $dir_name, $subdir_id, $subdir_name)
    {


        // кодируем
        $dir_name = trim(json_encode($dir_name), '"');
        $file_name = trim(json_encode($file_name), '"');

        //  echo "$file_name, $file_content, $dir_id, $dir_name, $subdir_id, $subdir_name";


        $c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"11111111111111\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 1,\n                    \"DisplayValue\": \"\u05d4\u05e0\u05d3\u05e1\u05d4\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1011,\n            \"TypedValue\": {\n                \"DataType\": 10,\n                \"Lookups\": [\n                    {\n                        \"DisplayValue\": \"11111111111111\",\n                        \"Item\": 164004\n                    }\n                ],\n                \"HasValue\": true\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 12727,\n                    \"DisplayValue\": \"1012 - \u05d4\u05d0\u05e9\u05db\u05e0\u05d6\u05d9 \u05d1\u05d9\u05ea \u05d0\u05dc \u05d0\' - \u05d1\u05d9\u05ea \u05d0\u05dc\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 38,\n                    \"DisplayValue\": \"\u05d0\u05e8\u05d5\u05df \u05e7\u05d5\u05d3\u05e9\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
        $c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $subdir_name . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 1,\n                    \"DisplayValue\": \"\u05d4\u05e0\u05d3\u05e1\u05d4\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1011,\n            \"TypedValue\": {\n                \"DataType\": 10,\n                \"Lookups\": [\n                    {\n                        \"DisplayValue\": \"" . $subdir_name . "\",\n                        \"Item\": 164004\n                    }\n                ],\n                \"HasValue\": true\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": false\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": " . $dir_id . ",\n                    \"DisplayValue\": \"" . $dir_name . "\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": 38,\n                    \"DisplayValue\": \"\u05d0\u05e8\u05d5\u05df \u05e7\u05d5\u05d3\u05e9\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
        $url = 'http://mfiles.lavi.co.il/REST/objects/0.aspx?checkIn=false&_method=POST';
        if ($this->debug) {
            echo $c;
            echo $url;
        }

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
        $response0 = curl_exec($ch);
        $response0 = json_decode($response0, true);
        if ($this->debug) {
            print_r($response0);
            echo "===============END STEP 1 =================\n\n\n\n";

        }
        /**
         * На выходе
         * displayID":"164005"
         *
         */
        $displayID = $response0['DisplayID'];
        $this->access4all_green_directory($displayID);
//        $displayID = '3-743';

        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////


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
        if ($this->debug) {
            print_r($response1);
            echo "===============END STEP 2 ================= \n\n\n\n";
        }

        $file_size = $response1['Size'];
        $uploadID = $response1['UploadID'];
        /**
         * Возвращаем
         * "UploadID":4,
         *
         */
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////

        $c = "[\n    {\n        \"UploadID\": " . $response1['UploadID'] . ",\n        \"Title\": \"" . $file_name . "\",\n        \"Extension\": \"" . $this->extantion . "\",\n        \"Size\": " . $file_size . ",\n        \"TempFilePath\": null\n    }\n]";
        $c = "[\n    {\n        \"UploadID\": " . $uploadID . ",\n        \"Title\": \"" . $file_name . "\",\n        \"Extension\": \"" . $this->extantion . "\",\n        \"Size\": " . $file_size . ",\n        \"TempFilePath\": null\n    }\n]";
        $url = 'http://mfiles.lavi.co.il/REST/objects/0/' . $displayID . '/1/files/upload.aspx?_method=POST';
        //$url = 'http://mfiles.lavi.co.il/REST/objects/0/164005/1/files/upload.aspx?_method=POST';


        if ($this->debug) {
            echo $c;
            echo $url;
        }

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
        $response2 = curl_exec($ch);
        $response2 = json_decode($response2, true);
        if ($this->debug) {
            print_r($response2);
            echo "===============END STEP 3 ================= \n\n\n\n";
        }
        $this->access4all_green_directory($response2['AddedFiles'][0]['ID']);


        return true;
    }


    public function upload_file_by_name_in_folder__________($file_name, $file_content, $dir_id)
    {

        // ТРИ ЗАПРОСА
        // 1. Предварительный аплоуд, получаем временный ID файла и его размер в $response1
        // ------2. Создаем Объект/Папка для хранения этого файла
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


    /**
     * @param $name
     * @return mixed
     */
    public function create_green_directory_________($name)
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
        $version = '1';
        if (isset($response1['ObjVer']['Version'])) $version = $response1['ObjVer']['Version'];

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

    /**
     * вспмогательный генератор массива
     */
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

    /**
     * $url
     * TODO: Скорей всего дает скачать файл или картинку. Впомнить что на входе подается
     */
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


}
