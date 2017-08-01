<?php
namespace frontend\controllers;

use frontend\models\Mfiles;
use kartik\mpdf\Pdf;
use yii\web\Controller;

/**
 * Site controller
 */
class PartitionController extends Controller
{
    public function beforeAction($action)
    {
        $cookies = \Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionColor()
    {
        return $this->render('color');
    }

    public function actionColor_catalog()
    {
        return $this->render('color_catalog');
    }

    public function actionFooter()
    {
        return $this->render('footer');
    }

    public function actionDecor()
    {
        return $this->render('decor');
    }

    public function actionSection()
    {
        return $this->render('section');
    }

    public function actionPdf()
    {
        return $this->render('pdf_s');
    }

    public function actionPdfResult()
    {
//        $vars = $this->getValues();
//        var_dump($vars);
//        die();

        // Берем параметры из сессии
        $cookies = \Yii::$app->request->cookies;

        $clientId  =  $cookies->getValue('dir_id_mfiles');
        $clientName = $cookies->getValue('dir_name_mfiles');

        $signFilePath='';

        // здесь данные из базы по нашей ФОРМЕ
//        $form_fields_from_db = $my_json_in[1];
        $form_fields_from_db['name'] = 'PARTITION';
        //$form_fields_from_db['internal_emails'] = 'ruslan.novikov@gmail.com;rlopatkin@gmail.com;l_rom@mail.ru;sergei.epshtein@gmail.com';
        $form_fields_from_db['internal_emails'] = 'makord1@yandex.ru';
        $form_fields_from_db['internal_message'] = 'Message';
        $form_fields_from_db['mfiles_meta_class_id'] = 10;
        $form_fields_from_db['mfiles_meta_dropdwn_001_id'] = 10;
        $form_fields_from_db['mfiles_meta_dropdwn_002_id'] = 10;


        $chert = './_partition/base/per'.$_GET['type'].'_'.$_GET['section'].'_1.png';

        $img1Name = $chert;
        $img1 = @imagecreatefrompng($img1Name);

        try
        {
            $img4 = @imagecreatefrompng('./_partition/base/per'.$_GET['type'].'_'.$_GET['section'].'_1.png');
            imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);
        } catch (\Exception $e){};
        try
        {
            $img4 = @imagecreatefrompng('./_partition/base/per'.$_GET['type'].'_'.$_GET['section'].'_'.$_GET['color'].'.png');
            imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);
        } catch (\Exception $e){};
        try
        {
            $img4 = @imagecreatefrompng('./_partition/niz/niz'.$_GET['footer'].'_'.$_GET['section'].'_'.$_GET['color'].'.png');
            imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);
        } catch (\Exception $e){};
        try
        {
            if(isset($_GET['decor']))
            {
                $img4 = @imagecreatefrompng('./_partition/uzor/uzor'.$_GET['decor'].'_'.$_GET['section'].'_'.$_GET['color'].'.png');
                imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);
            }

        } catch (\Exception $e){};



        // Сохраняем собранную картинку
        $fileName = $clientId . "_" . time() . "_" . rand(383, 1000);
        $imgFilePath = '../../_img.cache/' . $fileName . '.png';
//        header('Content-Type: image/gif');

        imagegif($img1, $imgFilePath);

        $content = '<table width="800px;" border="0"><tr><td style="text-align:center;"><img src="'.$imgFilePath.'" style="width:900px;"></td></tr></table><br/>';

        // Сборка из выбранных элементов

        // Цвет и тип


//        die();

        $content .= '<table style="width:700px;"><tr><td style="text-align:center;">'
            . '<br/><br/><br/><br/><br/><br/><br/><div style="font-family: freesans;font-size: 25px;">ההדמיה הינה להמחשה בלבד גוון הספריה, דלתות, עמודי הפרדה בין העמודות והאומנויות הינם ע"פ מפרט</div>'
            . '<br/><img src="'.$imgFilePath.'" style="width:650px;height:650px;margin:0px 0px 200px 0px;">'
            . '<br/><img src="./_altar/1/ftr.png" style="width:100%;">'
            . '</td></tr></table>';

        // Таблица из элементов
        // Формируем данные для записи в файл
        $content .= '<table  width="100%" cellpadding="5" border="1">';

        // Формируем данные в виде массива
        $rows = array();
        // Тип
//        $description = '';
//        switch ( $originType ) {
//            case 1:
//                $description = 'ארון קודש דביר ללא כיס פרוכת';
//                break;
//            case 2:
//                $description = 'ארון קודש דביר נמוך ללא כיס פרוכת';
//                break;
//            case 3:
//                $description = 'ארון קודש דביר נמוך עם כיס פרוכת';
//                break;
//            case 4:
//                $description = 'ארון קודש דביר עם כיס פרוכת';
//                break;
//        }
//        $rows[] = array(
//            '0' => $img1Name,
//            '1' => $description,
//        );

        // Тексты со страницы 2

        // Цвет со страницы 3
        try
        {
            $rows[] = array(
                '0' => './_partition/preview/per'.$_GET['type'].'.png',
                '1' => 'type #' . $_GET['type'],
            );
        } catch (\Exception $e){};


        try
        {
            $rows[] = array(
                '0' => './_altar/1/alt_color/wood'.$_GET['color'].'.jpg',
                '1' => 'Color #' . $_GET['color'],
            );
        } catch (\Exception $e){};

        $page4 = $_GET['color_catalog'];
        $f = 'b21.png';
        $colorName = 'b21';
        switch ( $page4 ) {
            case 5:
                $colorName = 'b21';
                $f = 'b21.png';
                break;
            case 6:
                $colorName = 'b23';
                $f = 'b23.png';
                break;
            case 7:
                $colorName = 'b24';
                $f = 'b24.png';
                break;

            case 8:
                $colorName = 'b11';
                $f = 'b11.png';
                break;
            case 9:
                $colorName = 'b13';
                $f = 'b13.png';
                break;
            case 10:
                $colorName = 'b19';
                $f = 'b19.png';
                break;
            case 11:
                $colorName = 'b22';
                $f = 'b22.png';
                break;
            case 12:
                $colorName = 'טבעי';
                $f = 'b_2.png';
                break;
            case 13:
                $colorName = 'b_0';
                $f = 'b_0.png';
                break;
            case 14:
                $colorName = 'אחר ע"פ המפרט';
                $f = 'bwhite.png';
                break;
        }
        $rows[] = array(
            '0' => './_altar/1/alt_color/' . $f,
            '1' => 'Color name ' . $colorName,
        );

        try
        {
            $rows[] = array(
                '0' => './_partition/preview/niz'.$_GET['footer'].'.png',
                '1' => 'footer #' . $_GET['footer'],
            );
        } catch (\Exception $e){};

        if(isset($_GET['decor']))
        {
            try
            {
                $rows[] = array(
                    '0' => './_partition/preview/uzor'.$_GET['decor'].'.png',
                    '1' => 'decor #' . $_GET['decor'],
                );
            } catch (\Exception $e){};
        }

        try
        {
            $rows[] = array(
                '0' => '',
                '1' => 'section #' . $_GET['section'],
            );
        } catch (\Exception $e){};


        $i = 0;

        foreach ($rows as $row) {

            if ( $row[0] == '' ) {
                $content .= "<tr><td align='right' style='width: 300px;font-family: freesans'>" . $row[1] . "</td>
                <td align='right' style='font-family: freesans'>".'ללא'."</td></tr>";
            } else {
                // важно для иврита этот шрифт style="font-family: freesans"
                $content .= "<tr><td align='right' style='width: 300px;font-family: freesans'>" . $row[1] . "</td>
                <td align='right' style='font-family: freesans'><img src='" . $row[0] . "' style='width:150px;'></td></tr>";
            }
            //постарничная разбивка
//            if (!$i % 2) {
//                $content .= '</table><table width="100%" cellpadding="5" border="1">';
//            }
            $i++;
        }

        $content .= '</table>';

        // Генерируем выходной pdf-файл
        $pdf = new Pdf([
            'filename' => '../../_result.pdf.cache/'. $fileName .'.pdf',
            'destination' => 'F',

            'mode' => Pdf::MODE_BLANK, // leaner size using standard fonts
            'cssFile' => 'vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'content' => $this->renderPartial('pdf',
                [
                    'content' => $content,
                    'title' => $form_fields_from_db['name'],
                    //'signFilePath' => $signFilePath,
                ]),
            'options' => [
                'title' => 'Lavi Altar forms',
                'subject' => 'Generating by Lavi comp'
            ],
            'methods' => [
                'SetHeader' => ['Lavi comp. ' . date("r")],
                'SetFooter' => ['|' . date("r")],
            ]
        ]);

        $pdf->render();

        // Удаляем ненужные кеши
        foreach (glob("../../_result.json.cache/" . $clientId . "_*") as $filename) {
            unlink($filename);
        }
        //$pdf;
        ////////////////////////////
        $mfiles = new Mfiles();
        $mfiles->extantion = 'pdf';
        // имя файла upload
        $fileNameMfiles = $clientName . '_partition_' . date('Y-m-d') . "__at__" . date('H-i-s');
        // собранный файл грузим на фмафлс

        $file_id = $mfiles->upload_file_by_name_in_folder(
            $fileNameMfiles,
            file_get_contents('../../_result.pdf.cache/' . $fileName . '.pdf'),
            $clientId,
            $clientName,
            '0',
            $form_fields_from_db['name']
        // ЭТО НЕОБЯЗАТЕЛЬНЫЕ МЕТАДАННЫЕ ДЛЯ СОЗДАНИЯ СЛОЖНОГО ОБЪЕКТА В МФАЙЛС
        // ЭТО НЕОБЯЗАТЕЛЬНЫЕ МЕТАДАННЫЕ ДЛЯ СОЗДАНИЯ СЛОЖНОГО ОБЪЕКТА В МФАЙЛС
        // ЭТО НЕОБЯЗАТЕЛЬНЫЕ МЕТАДАННЫЕ ДЛЯ СОЗДАНИЯ СЛОЖНОГО ОБЪЕКТА В МФАЙЛС
        // ЭТО НЕОБЯЗАТЕЛЬНЫЕ МЕТАДАННЫЕ ДЛЯ СОЗДАНИЯ СЛОЖНОГО ОБЪЕКТА В МФАЙЛС
//            $classname_multfolder_pd100 = $form_fields_from_db['mfiles_meta_class_id'],//'לביצוע', // соотве ади смотри в аяксе выпадающего меню формы
//            $dropdwn_filed_pd1093 = $form_fields_from_db['mfiles_meta_dropdwn_001_id'],//'מכירות',
//            $dropdwn_filed_pd1133 = $form_fields_from_db['mfiles_meta_dropdwn_002_id'] //'שולחן קריאה'
        );

        // отпрвляем почту
        if ($form_fields_from_db['internal_emails']) {
            preg_match_all('~([^\s,;]+)~', $form_fields_from_db['internal_emails'], $d);
//                print_r($d);
            $message = '<h4>Client: ' . $clientName . '</h4>' .
                '<h4>PDF saved to Mfiles directory: <a href="http://mfiles.lavi.co.il/Default.aspx?#F9930A12-4EE5-473F-A871-CADEE360639E/object/' . $file_id . '/latest">here</a></h4>';

            $test =    '<h4>Client: ' . $clientName . '</h4>' .
                //'<h4>Form: ' . $form_fields_from_db['name'] . '</h4>' .
                '<h4>Internal notice: ' . $form_fields_from_db['internal_message'] . '</h4>' .
                '<h4>PDF saved to Mfiles directory: <a href="http://mfiles.lavi.co.il/Default.aspx?#F9930A12-4EE5-473F-A871-CADEE360639E/object/' . $file_id . '/latest">here</a></h4>' .
                //'<p><img src=""></p>';
                //'<h4>Data filling by client:</h4><br>' . $content .
                //'<p><img src="http://img.lavi.new-dating.com/' . $fileName . '.png"></p>' .
                '<table border="0">
<tr>
    <td valign="top" height="150px">
        <img src="http://img.lavi.new-dating.com/logo.png" width="150px">
    </td>
</tr>
</table>

<center>
<h1>
' . $form_fields_from_db['name'] . '
</h1>
' . $content . '
</center>

<table>
<tr>
    <td valign="middle" height="300px">
        <img src="http://img.lavi.new-dating.com/' . $fileName . '.png">
    </td>
    <td valign="middle" height="300px">
        <!--h4>Client signature </h4--//>
    </td>
</tr>
</table>';

//        var_dump($fileName);die();
//            $message = Yii::$app->mailer->compose();
//            $message->attach('../../_result.pdf.cache/'. $fileName .'.pdf');
//            $message->attachContent('Attachment content', ['fileName' => 'attach.txt', 'contentType' => 'text/plain']);

            /*foreach ($d[1] as $email) {
                if (trim($email)) {
//                    echo $email.'<br/>';
                    Yii::$app->mailer->compose()
                        ->setFrom('fursales1@gmail.com')
                        ->setTo($email)
//                        ->setTo('rlopatkin@gmail.com')
                        ->setSubject('LAVI new ALTAR form')
                        //->setTextBody('Plain text content')
                        ->setHtmlBody($message)
                        ->send();
                }
            }*/
        }
//        die();
//        echo $fileName;

        return $this->render('pdf-result',['url'=>'http://mfiles.lavi.co.il/Default.aspx?#F9930A12-4EE5-473F-A871-CADEE360639E/object/' . $file_id . '/latest']);
    }
}
