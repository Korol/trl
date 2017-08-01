<?php
namespace frontend\controllers;


use frontend\models\Mfiles;
use Yii;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


use kartik\mpdf\Pdf;


/**
 * Site controller
 */
class TestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        Yii::$app->mailer->compose()
            ->setFrom('fursales1@gmail.com')
            ->setTo('info@novikov.ua')
            ->setSubject('LAVI new filling form')
            //->setTextBody('Plain text content')
            ->setHtmlBody("<b>test</b>")
            ->send();

        exit;

        preg_match_all('~([^\s,;]+)~', 'ruslan.novikov@gmail.com, innfo@novikov.ua, justmynickname@ya.ru', $d);
        print_r($d[1]);

        exit;


        $mfiles = new Mfiles();
        $mfiles->extantion = 'pdf';


        /*     echo " 001 ->" . $file_id = $mfiles->upload_file_by_name_in_folder(
                      'name_pdf_001', //имя PDF
                      '<p>test</p>', //тупо контент
                      '11119', //внутренний ID mfiles клиента из куки
                      '100 - מדיקל סנטר - הרצליה', //название папки клиента mfiles клиента из куки
                      0, //??
                      'name_multifolder_001', //имя мультипапки
                      //new
                      $classname_multfolder_pd100 = '43' ,//'לביצוע', // соотве ади смотри в аяксе выпадающего меню формы
                      $dropdwn_filed_pd1093 = '47' ,//'מכירות',
                      $dropdwn_filed_pd1133 = '117' //'רמת כלל הפרוייקט' //ьтп мебели но в данном слкчае "Проект на всех уровнях"
                  );
     */
        /*
                echo " 002 ->" . $file_id = $mfiles->upload_file_by_name_in_folder(
                        'name_pdf_002', //имя PDF
                        '<p>test</p>', //тупо контент
                        '11119', //внутренний ID mfiles клиента из куки
                        '100 - מדיקל סנטר - הרצליה', //название папки клиента mfiles клиента из куки
                        0, //??
                        'name_multifolder_002', //имя мультипапки
                        //new
                        $classname_multfolder_pd100 = '43',//'לביצוע', // соотве ади смотри в аяксе выпадающего меню формы
                        $dropdwn_filed_pd1093 = '47' ,//'מכירות',
                        $dropdwn_filed_pd1133 = '106' //'ארון קודש'
                    );*/

        /*    echo " 003 ->" . $file_id = $mfiles->upload_file_by_name_in_folder(
                    'name_pdf_003', //имя PDF
                    '<p>test</p>', //тупо контент
                    '11119', //внутренний ID mfiles клиента из куки
                    '100 - מדיקל סנטר - הרצליה', //название папки клиента mfiles клиента из куки
                    0, //??
                    'name_multifolder_003', //имя мультипапки
                    //new
                    $classname_multfolder_pd100 = '43',//'לביצוע', // соотве ади смотри в аяксе выпадающего меню формы
                    $dropdwn_filed_pd1093 = '47',//'מכירות',
                    $dropdwn_filed_pd1133 = '107' //'בימה'
                );*/

        /*      echo " 004 ->" . $file_id = $mfiles->upload_file_by_name_in_folder(
                      'name_pdf_004', //имя PDF
                      '<p>test</p>', //тупо контент
                      '11119', //внутренний ID mfiles клиента из куки
                      '100 - מדיקל סנטר - הרצליה', //название папки клиента mfiles клиента из куки
                      0, //??
                      'name_multifolder_004', //имя мультипапки
                      //new
                      $classname_multfolder_pd100 = '43',//'לביצוע', // соотве ади смотри в аяксе выпадающего меню формы
                      $dropdwn_filed_pd1093 = '47',//'מכירות',
                      $dropdwn_filed_pd1133 = '113' //'שולחן קריאה'
                  );*/
        /*
                echo " 005 ->" . $file_id = $mfiles->upload_file_by_name_in_folder(
                        'name_pdf_005', //имя PDF
                        '<p>test</p>', //тупо контент
                        '11119', //внутренний ID mfiles клиента из куки
                        '100 - מדיקל סנטר - הרצליה', //название папки клиента mfiles клиента из куки
                        0, //??
                        'name_multifolder_005', //имя мультипапки
                        //new
                        $classname_multfolder_pd100 = '8',//'מכירות', // соотве ади смотри в аяксе выпадающего меню формы
                        $dropdwn_filed_pd1093 = '59',//'רמת כלל הפרוייקט',
                        //
                        $dropdwn_filed_pd1133 = '113' //'שולחן קריאה' // что делать это поле не нуно ????
                    );
        */


        // echo trim(json_encode('רמת כלל הפרוייקט'), '"'); //кодируем в \u05d4\u05e0\u05d3\u05e1\u05d4

        $file_name = 'ФИЛЕНАМЕ'; //имя PDF
        $file_content = 'КОНТЕНТ'; //тупо контент
        $dir_id_pd1064 = '**АЙДИДИР'; //внутренний ID mfiles клиента из куки
        $dir_name_pd1064 = '**НЕЙМДИР'; //название папки клиента mfiles клиента из куки
        $subdir_id = 0; //??
        $subdir_name_pd0 = "**ИМЯМУЛЬТИПАП"; //имя мультипапки
        //new
        $classname_multfolder_pd100 = '**43';//'לביצוע'; // соотве ади смотри в аяксе выпадающего меню формы
        $dropdwn_filed_pd1093 = '**47';//'מכירות';
        $dropdwn_filed_pd1133 = '**117'; //ьтп мебели но в


        echo $c = "{\n    \"PropertyValues\": [\n        {\n            \"PropertyDef\": 0,\n            \"TypedValue\": {\n                \"DataType\": 1,\n                \"Value\": \"" . $subdir_name_pd0 . "\",\n                \"HasValue\": true,\n                \"IsMultiValue\": false\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 39,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n                                                   {\n            \"PropertyDef\": 99,\n            \"TypedValue\": {\n                \"DataType\": 9\n            },\n            \"HasValue\": false,\n            \"IsAutomatic\": false\n        },\n        {\n            \"PropertyDef\": 100,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": " . $classname_multfolder_pd100 . ",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true\n        },\n        {\n            \"PropertyDef\": 1064,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                   \"Item\": " . $dir_id_pd1064 . ",\n                    \"DisplayValue\": \"" . $dir_name_pd1064 . "\"\n               }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1093,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": \"" . $dropdwn_filed_pd1093 . "\",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        },\n        {\n            \"PropertyDef\": 1133,\n            \"TypedValue\": {\n                \"DataType\": 9,\n                \"Lookup\": {\n                    \"Item\": " . $dropdwn_filed_pd1133 . ",\n                    \"DisplayValue\": \"POFIG\"\n                }\n            },\n            \"HasValue\": true,\n            \"IsAutomatic\": false,\n            \"IsClassAssociated\": true\n        }\n    ],\n    \"Workflow\": null,\n    \"TemplateForFiles\": null,\n    \"Files\": null,\n    \"NamedACL\": -1,\n    \"ACL\": {\n        \"IsUnSpecified\": false,\n        \"CheckedOutToUserID\": -2147483648,\n        \"HasCheckedOutToUserID\": false,\n        \"IsFullyAuthoritative\": false,\n        \"AutomaticComponents\": [],\n        \"CustomComponent\": {\n            \"AccessControlEntries\": [\n                {\n                    \"ChangePermissionsPermission\": 1,\n                    \"EditPermission\": 1,\n                    \"ReadPermission\": 1,\n                    \"DeletePermission\": 1,\n                    \"IsGroup\": true,\n                    \"UserOrGroupID\": 1,\n                    \"IsPsudoUser\": false,\n                    \"HasConcreteUserOrGruopID\": true\n                }\n            ],\n            \"CanDeactivate\": false,\n            \"CurrentUserBinding\": -2147483648,\n            \"HasCurrentUser\": false,\n            \"HasCurrentUserBinding\": false,\n            \"HasNamedACLLink\": true,\n            \"HasPseudoUsers\": false,\n            \"IsActive\": true,\n            \"NamedACLLink\": -1\n        }\n    },\n    \"IsBlankTemplate\": false\n}";
        exit;

        $a = '\u05de\u05db\u05d9\u05e8\u05d5\u05ea';
        print_r(json_decode('{"t":"' . $a . '"}'));


        exit;
        $mfiles = new Mfiles();
        $search_list = $mfiles->search_in_dir_by_title_name('1000');

        //        $this->view->registerCssFile('vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css');
//
////
//        return $this->renderPartial('view');
//        exit;


    }

}
