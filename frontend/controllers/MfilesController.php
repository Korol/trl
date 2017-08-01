<?php
namespace frontend\controllers;

use common\models\Googleforms;
use frontend\models\Mfiles;
use kartik\mpdf\Pdf;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class MfilesController extends Controller
{

    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'googleform', 'webcamphoto', 'markedphoto', 'google-forms-uload-signature-and-pdf'],
                        'allow' => true,
                        'roles' => ['@', '?'],
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
                    //'googleform' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */


    public function actionWebcamphoto()
    {
        if (isset($_FILES['webcam']['tmp_name'])) {
            $file_name_mfiles = md5(time()) . rand(383, 1000) . '.jpg';
            $file_name_path = '../../_photo.cache/' . $file_name_mfiles;
            // сохраним во временный кэш только не забыть его едемесячно чистить
            // TODO: Ежемесячно крон очистки кэша !!!!!
            move_uploaded_file($_FILES['webcam']['tmp_name'], $file_name_path);

            $cookies = Yii::$app->request->cookies;
            $dir_id_mfiles = $cookies->getValue('dir_id_mfiles');
            $dir_name_mfiles = $cookies->getValue('dir_name_mfiles');

            $mfiles = new Mfiles();
//            $mfiles->debug = true;
            $mfiles->extantion = 'jpg';


////            echo "<pre>";
////            echo "<br>
////создаем новую директорию $dir_name_mfiles ";
//            $dir_id = $mfiles->create_green_directory($dir_name_mfiles);
//// снимаем метку ТОЛЬКО Я с директории
////            echo "<br>
////снимаем галочку возле иконки - ВЕРНУТЬ вместо ИЗЪЯТЬ иначе доступа у других к ней нет $dir_id ";
//            $mfiles->access4all_green_directory($dir_id);
//*/

// имя файла upload
            $file_name_mfiles = $dir_name_mfiles . '_photo_' . date('Y-m-d') . "__at__" . date('H-i-s');
            $file_content = file_get_contents($file_name_path);

// собранный файл грузим на фмафлс
//            echo "
//Upload! <br> See http://mfiles.lavi.co.il/Default.aspx?#F9930A12-4EE5-473F-A871-CADEE360639E/relationships/104/916/latest";
            $file_id = $mfiles->upload_file_by_name_in_folder($file_name_mfiles, $file_content, $dir_id_mfiles, $dir_name_mfiles, '0', 'photos');
//              echo "<br>
//снимаем галочку возле иконки - ВЕРНУТЬ вместо ИЗЪЯТЬ иначе доступа у других к ней нет ";
            //$mfiles->access4all_green_directory($file_id);

////echo json_encode($_POST);
//$log_path = './';
//$fd = fopen($log_path . "_google.log", "a");
//fwrite($fd, "" . date("Ymd G:i:s") . " - " . $file_content . "\n");
//fclose($fd);
//            echo "</pre>";


        }//
        else {
            die("Bad request");
        }

        return ' Uploaded to M-files';
    }


    // полученое фото аплоудим на хостинг иг сразу отправляем на МФАЙЛС
    public function actionMarkedphoto()
    {

//        print_r($_POST);
        $url = 'http://lavi.new-dating.com/site/marking-photo-generatefile?photo_id=' .
            $_POST['photo_id'] . '&id=' . $_POST['client_id'] . '&name=' .
            urlencode($_POST['client_name']) .
            '&cords=' . urlencode($_POST['newData']) .
            '&comments=' . urlencode($_POST['comments']);
        $file_content = file_get_contents($url);


        //
        $file_name_mfiles = $_POST['client_name'] . '_photo_marking_' . date('Y-m-d') . "__at__" . date('H-i-s');
        $file_name_path = '../../_photo_marking.cache/' . $file_name_mfiles . '.html';


        // резервный кэш на стлучай сбоя мфайлс
        $fd = fopen($file_name_path, "w");
        fwrite($fd, $file_content);
        fclose($fd);


        $mfiles = new Mfiles();
//            $mfiles->debug = true;
        $mfiles->extantion = 'html';
        $file_id = $mfiles->upload_file_by_name_in_folder($file_name_mfiles, $file_content, $_POST['client_id'], $_POST['client_name'], '0', 'photo_marking');


        return ' Uploaded to M-files';
    }

    public function actionGoogleFormsUloadSignatureAndPdf()
    {


        if (isset($_FILES['signature_img']['tmp_name'])) {
            //

            $cookies = Yii::$app->request->cookies;
            $dir_id_mfiles = $cookies->getValue('dir_id_mfiles');
            $dir_name_mfiles = $cookies->getValue('dir_name_mfiles');


            $file_name_local = $dir_id_mfiles . "_" . time() . "_" . rand(383, 1000);
            $file_name_path = '../../_result.signs.cache/' . $file_name_local . '.png';
            // сохраним во временный кэш только не забыть его едемесячно чистить
            //
            move_uploaded_file($_FILES['signature_img']['tmp_name'], $file_name_path);


            //табличка с последним заполненым фомой этогокдиента готовм
            //отсортированф по алфавиту - берем последний
            $filename = '';
            foreach (glob("../../_result.json.cache/" . $dir_id_mfiles . "_*") as $filename) {
            }
            if (!$filename) {
                return "No Google Form result";
            }
            $my_json_in = json_decode(file_get_contents($filename), true);
            $form_rows = $my_json_in[0];
            // здесь данные из базы по нашей ФОРМЕ
            // здесь данные из базы по нашей ФОРМЕ
            // здесь данные из базы по нашей ФОРМЕ
            $form_fields_from_db = $my_json_in[1];
            //
            $i = 1;
            $table_html_rows = '<table  width="100%" cellpadding="5" border="0">';
            foreach ($form_rows as $row) {
                // важно для иврита этот шрифт style="font-family: freesans"
                $table_html_rows .= "<tr><td align='right' style='font-family: freesans'>" . $row[1] . "</td>
                <td align='right' style='font-family: freesans'>" . $row[0] . "</td></tr>";
                //постарничная разбивка
                if (!$i % 5) {
                    $table_html_rows .= '</table><table width="100%" cellpadding="5" border="0">';
                }
                $i++;
            }
            $table_html_rows .= '</table>';
            //

            $pdf = new Pdf([
                'filename' => '../../_result.pdf.cache/' . $file_name_local . '.pdf',
                'destination' => 'F',

                'mode' => Pdf::MODE_BLANK, // leaner size using standard fonts
                'cssFile' => 'vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                'content' => $this->renderPartial('pdf',
                    [
                        'table_html_rows' => $table_html_rows,
                        'title' => $form_fields_from_db['name'],
                        'sign_img_pah' => '../../_result.signs.cache/' . $file_name_local . '.png',
                    ]),
                'options' => [
                    'title' => 'Lavi forms',
                    'subject' => 'Generating by Lavi comp'
                ],
                'methods' => [
                    'SetHeader' => ['Lavi comp. ' . date("r")],
                    'SetFooter' => ['|' . date("r")],
                ]
            ]);

//            $pdf->filename = '../../_result.pdf.cache/1.pdf';
            $pdf->render();

            // ПДФ генерился в файл, можно удялть кэш таблицы чтобы в след раз не подвернулся
            //табличка с последним заполненым фомой этогокдиента готовм
            foreach (glob("../../_result.json.cache/" . $dir_id_mfiles . "_*") as $filename) {
                unlink($filename);
            }


            $mfiles = new Mfiles();
            $mfiles->extantion = 'pdf';
// имя файла upload
            $file_name_mfiles = $dir_name_mfiles . '_googleforms_' . date('Y-m-d') . "__at__" . date('H-i-s');
// собранный файл грузим на фмафлс


            /**
             * [id] => 2
             * [name] => לוגיסטיקה
             * [google_id] => https://docs.google.com/forms/d/e/1FAIpQLSfbgXc-iiUjsm1CnqWDANj_f8AD-AAXw-yb2W8CScGBVvgoWQ/viewform
             * [google_id_editmode] => https://docs.google.com/forms/d/1pQQOz_WfD0axRv11YwR3Tziv8M_y2BmdE6fWCe230Po/edit
             * [comment] => entry.1943301741
             * [mfiles_meta_class_id] => 0
             * [mfiles_meta_dropdwn_001_id] => 0
             * [mfiles_meta_dropdwn_002_id] => 0
             * 'internal_message',
             * 'internal_emails',
             */


            $file_id = $mfiles->upload_file_by_name_in_folder(
                $file_name_mfiles,
                file_get_contents('../../_result.pdf.cache/' . $file_name_local . '.pdf'),
                $dir_id_mfiles,
                $dir_name_mfiles,
                '0',
                $form_fields_from_db['name'],
                $classname_multfolder_pd100 = $form_fields_from_db['mfiles_meta_class_id'],//'לביצוע', // соотве ади смотри в аяксе выпадающего меню формы
                $dropdwn_filed_pd1093 = $form_fields_from_db['mfiles_meta_dropdwn_001_id'],//'מכירות',
                $dropdwn_filed_pd1133 = $form_fields_from_db['mfiles_meta_dropdwn_002_id'] //'שולחן קריאה'
            // метаданные

            );


            // отпрвляем почту
            // отпрвляем почту
            // отпрвляем почту
            // отпрвляем почту

            /**
             *
             * http://img.lavi.new-dating.com
             * указывает на
             * /home/lavi/public_html/_result.signs.cache
             * на хера сделал н епомню -ч то тосвязано с паролями htaccess
             *
             *
             */


            if ($form_fields_from_db['internal_emails']) {
                preg_match_all('~([^\s,;]+)~', $form_fields_from_db['internal_emails'], $d);
//                print_r($d);
                $message =
                    '<h4>Client: ' . $dir_name_mfiles . '</h4>' .
                    //'<h4>Form: ' . $form_fields_from_db['name'] . '</h4>' .
                    '<h4>Internal notice: ' . $form_fields_from_db['internal_message'] . '</h4>' .
                    '<h4>PDF saved to Mfiles directory: <a href="http://mfiles.lavi.co.il/Default.aspx?#F9930A12-4EE5-473F-A871-CADEE360639E/object/' . $file_id . '/latest">here</a></h4>' .
                    //'<p><img src=""></p>';
                    //'<h4>Data filling by client:</h4><br>' . $table_html_rows .
                    //'<p><img src="http://img.lavi.new-dating.com/' . $file_name_local . '.png"></p>' .
                    '<table width="100%" border="0">
     <tr>
        <td valign="top" align="left"  width="50%">
            <img src="http://img.lavi.new-dating.com/logo/logo_en.png"  height="100px">
        </td>
        <td valign="top" align="right" width="50%">
            <img src="http://img.lavi.new-dating.com/logo/logo.png"  height="100px">
        </td>

    </tr>
</table>

<center>
<h1>
    ' . $form_fields_from_db['name'] . '
</h1>
    ' . $table_html_rows . '
</center>

<table>
    <tr>
        <td valign="middle" height="300px">
            <img src="http://img.lavi.new-dating.com/' . $file_name_local . '.png">
        </td>
        <td valign="middle" height="300px">
            <h4>Client signature </h4>
        </td>
    </tr>
</table>';


                foreach ($d[1] as $email) {
                    if (trim($email)) {
                        echo $email;
                        Yii::$app->mailer->compose()
                            ->setFrom('fursales1@gmail.com')
                            ->setTo($email)
                            ->setSubject('LAVI new filling form')
                            //->setTextBody('Plain text content')
                            ->setHtmlBody($message)
                            ->send();
                    }
                }
            }

        }//
        else {
            return "Bad request";
        }

        return 'Uploaded to M-files';
    }


    public function actionGoogleform()
    {

        // принимает данные из Гглу формс https://docs.google.com/forms/d/1pQQOz_WfD0axRv11YwR3Tziv8M_y2BmdE6fWCe230Po/edit
        // и фигачит дальше на мфайлс сервер http://mfiles.lavi.co.il/Default.aspx?#F9930A12-4EE5-473F-A871-CADEE360639E/relationships/104/916/latest
        /**
         * для тестов варант
         * http://requestmaker.com/
         * http://lavi.new-dating.com/mfiles/googleform
         * message=##מספר לקוח: %25%251005 - גאולת ישראל - חולון##האם קיים קושי?%25%25אין קושי##יש בעיה, פרט:%25%25##רוחב הרחוב%25%25רחב##בעייתי, פרט:%25%25##אפשרות לחניה%25%25יש##בעייתי, פרט:%25%25##מרחק בין חניה לדלת כניסה%25%25עד 10 מ'##רוחב פתח כניסה%25%25מעל 1.5 מ'##פירוט:%25%25##קומת עזרת גברים%25%25קרקע##פירוט:%25%25##קומת עזרת נשים%25%25קרקע##פירוט:%25%25##יש, פרט:%25%25##יותר מ-6, פרט:%25%25##נדרש מנוף%25%25לא##הערות נוספות:%25%25
         */
        //debug
        if (!isset($_POST['id'])) $_POST['id'] = 1;
        // debug
        if (!isset($_POST['message'])) {
            if ($file = fopen('../../_result.json.cache/_message_dontmove', "r")) {
                while (!feof($file)) {
                    $line[] = fgets($file);
                    # do same stuff with the $line
                }
                fclose($file);
            }
            $_POST['message'] = trim($line[0]);
            $_POST['id'] = trim($line[1]);
            //die('Method post is empty!');
        }

////        // debug пишем что гугл пердаеи в файл
//        $filename = "../../_result.json.cache/_message_dontmove_".time();
//        $fd = fopen($filename, "a");
//        fwrite($fd, $_POST['message'] . "\n" . $_POST['id']);
//        fclose($fd);
////        exit;

        //вытаскиваем данные о гугл форме из нашей базы
        $dbForm = Googleforms::find()
            ->Where('`google_id_editmode` LIKE \'%' . $_POST['id'] . '%\'')
            ->asArray()
            ->one();
        if (!$dbForm) die ("В базе нет такой формы " . $_POST['id']);

        // дагнные из гугл формс
        $rows = explode('##', trim($_POST['message'], '##'));
        if (!sizeof($rows)) die('Error parse MESSAGE');

        $file_content_first = '';
        $file_content_second = '';
        $file_content_first_arr = [];
        $file_content_second_arr = [];
        $i = 0;
        foreach ($rows as $r) {
            $i++;
            $a = explode('%%', $r);
            if (!isset($a[1])) continue;
            //
            $a[0] = trim($a[0], ': ');
            $a[1] = trim($a[1], ': ');
            //
            $searches = array("\r", "\n", "\r\n");
            $a[1] = str_replace($searches, "", $a[1]);
            //
            //только если если есть ответ, накплаливаем строки
            if ($a[1]) {
                $file_content_first_arr[] = $a[0];
                $file_content_second_arr[] = $a[1];
                //
                $cache_rows[] = [$a[0], $a[1]];
            }

            // номер клиента = имя папки !!! если клиент заполнил напрямую форму на ГУГЛЕ -
            // ОНА не сохраняется
            // т.к. имя клиента дожно ровняться иени папки
            // иначе нихера никуда не сохранится


            // Рудимент - но пусть будет реальный айли клиента по мйайлс нам то и не нужен
            // если тут мы не пишем на мфайлс
            // теперь мы пишем бальше см actionGoogleFormsUloadSignatureAndPdf()
//            if ($a[0] == 'מספר לקוח') {
            if ($i == 1) {

                $client_name_mfiles = $a[1]; // вида 10005 - ИМЯ КЛИЕНТА
                // костыль - нам нужен ID клиента - пытаемся вычилсить его по названию предзаполненого первого поля формы
                // тупо по регулярке НЕ получится тк ID внутрнний и из названия клиента нихера не понять
                $mfiles = new Mfiles();
                $search_list = $mfiles->search_in_dir_by_title_name($client_name_mfiles);

                if (!$search_list['error']) {
                    $dir_id_mfiles = $search_list['result'][0]['id'];
                }
            }
            //
        }//foreach


        if ($dir_id_mfiles) {

            /**  рудимент
             * // создаем Эксэдб
             * $mfiles = new Mfiles();
             * $mfiles->extantion = 'xls';
             * $excel_filename_path = $mfiles->generateExcellContent(
             * $file_content_first_arr,
             * $file_content_second_arr
             * );
             * */

            // ЭТО ВАЖНО передаем на соед этап пописи и генерации ПДФ в actionGoogleFormsUloadSignatureAndPdf()
            // пишем кэш JSON
            $filename = "../../_result.json.cache/" . $dir_id_mfiles . "_" . time();
            $fd = fopen($filename, "w");
            fwrite($fd, json_encode([$cache_rows, $dbForm]));
            fclose($fd);


            // ДАЛЕЕ ПОСЛЕ ПОДПИСИС ОБРАБОТЧИК /mfiles/google-forms-uload-signature-and-pdf
            // ДАЛЕЕ ПОСЛЕ ПОДПИСИС ОБРАБОТЧИК /mfiles/google-forms-uload-signature-and-pdf
            // ДАЛЕЕ ПОСЛЕ ПОДПИСИС ОБРАБОТЧИК /mfiles/google-forms-uload-signature-and-pdf
            // ДАЛЕЕ ПОСЛЕ ПОДПИСИС ОБРАБОТЧИК /mfiles/google-forms-uload-signature-and-pdf
            // ДАЛЕЕ ПОСЛЕ ПОДПИСИС ОБРАБОТЧИК /mfiles/google-forms-uload-signature-and-pdf

            /**
             * кукиесы допизды т.к. сюда заходит робот гугла
             */
//        $cookies = Yii::$app->request->cookies;
//        $dir_id_mfiles = $cookies->getValue('dir_id_mfiles');
//        $dir_name_mfiles = $cookies->getValue('dir_name_mfiles');

            /** РУДИМЕНТ
             * $mfiles = new Mfiles();
             * $mfiles->extantion = 'xls';
             * $file_name_mfiles = $client_name_mfiles . '_google_forms_' . date('Y-m-d') . "__at__" . date('H-i-s');
             * $file_content = file_get_contents($excel_filename_path);
             * $file_id = $mfiles->upload_file_by_name_in_folder($file_name_mfiles, $file_content, $dir_id_mfiles, $client_name_mfiles, '0', 'googleforms');
             */
        }

        return true;
    }

}
