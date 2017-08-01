<?php
namespace frontend\controllers;

use Yii;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Cookie;
use yii\web\Session;
use common\models\Googleforms;
use common\models\GoogleformsSearch;
use yii\web\NotFoundHttpException;
use frontend\models\Mfiles;
use kartik\mpdf\Pdf;

/**
 * Altar controller
 */
class AltarController extends Controller
{
    // Переменная для хранения сессии
    private $s;

    public function beforeAction($action)
    {
        $this->s = Yii::$app->session;

        $cookies = Yii::$app->request->cookies;
        // Если у нас нет сессии или в ней нет клиента, то пытаемся получить это из кук
//        if ( !$this->s->has('client_id') ) {

//            $cookies = Yii::$app->request->cookies;

            // Проверяем наличие установленного клиента в куках
            $clientId = $cookies->getValue('dir_id_mfiles');
            if ( $clientId == null ) {
                return $this->redirect("/site/client")->send();
            }

//            var_dump($cookies->getValue('dir_name_mfiles'));die();
            // Запихиваем клиента в сессию
            $this->s->set('client_id', $cookies->getValue('dir_id_mfiles'));
            $this->s->set('client_name', $cookies->getValue('dir_name_mfiles'));
//        }

        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // Перечень всех пеерменных, котоорые соберутся в процессе прохождения всей процедуры
    private function getVars()
    {
        $vars = [
            'client_id',
            'client_name',
            'title_color_type',
            'type',
            //'page2',
            'color',
            'cornice',
            'door',
            'freize',
//            'freize_rez',
//            'freize_che',
//            'freize_laz',
            'page2',
            'page4',
            'page7',
            'verx',
            'title',
            'page11_1',
            'page11_2',
            'page11_3',
            'page11_4',
            'page11_5',
            'sign',
        ];

        return $vars;
    }

    // Рендерит в заданный шаблон все накопленные переменные
    private function returnRender( $varName, $model = null ) {

        $vars = array(
            'var_name' => $varName
        );

        foreach( $this->getVars() as $var) {
            if ( $this->s->has($var) ) {
                $vars[$var] = $this->s->get($var);
            }
        }

        if ( $model ) {
            $vars['model'] = $model;
        }

//        var_dump($vars);die();

        return $this->render($varName, $vars);
    }

    private function getValues()
    {
        $result = array();

        foreach( $this->getVars() as $var) {
            if ( $this->s->has($var) ) {
                $result[$var] = $this->s->get($var);
            }
        }

        return $result;
    }

    public function actionType()
    {
        $varName = 'type';

        foreach($this->getVars() as $var) {
            if ($this->s->has($var)) {
                if ( ($var != 'client_id') && ($var != 'client_name') ){
                    $this->s->set($var, 0);
                }
            }
        }

        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $varValue = abs($varValue - 5);
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/color');//page2
            }
        }
        return $this->returnRender($varName);
    }

    public function actionPage2()
    {
        $varName = 'page2';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/color');
            }
        }
        return $this->returnRender($varName);
    }

    public function actionColor()
    {
        $varName = 'color';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/page4');
            }
        }
        return $this->returnRender($varName);
    }

    public function actionPage4()
    {
        $varName = 'page4';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/cornice');
            }
        }
        return $this->returnRender($varName);
    }

    public function actionCornice()
    {
        $varName = 'cornice';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/door');
            }
        }
        return $this->returnRender($varName);
    }

    public function actionDoor()
    {
        $varName = 'door';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $varValue = abs($varValue - 4);
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/freize');
            }
        }
        return $this->returnRender($varName);
    }

    public function actionFreize()
    {
        $varName = 'freize';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/page7');
            }
        }
        return $this->returnRender($varName);
    }

//    public function actionFreizeRez()
//    {
//        $varName = 'freize_rez';
//        $request = Yii::$app->request;
//        if ( $request->isPost ) {
//            if ( $varValue = $request->post($varName, 0) ) {
//                $this->s->set($varName, $varValue);
//                $this->s->set('freize_che', $varValue);
//                return $this->redirect('/altar/freize-laz');
//            }
//        }
//        return $this->returnRender($varName);
//    }
//
//    public function actionFreizeLaz()
//    {
//        $varName = 'freize_laz';
//        $request = Yii::$app->request;
//        if ( $request->isPost ) {
//            if ( $varValue = $request->post($varName, 0) ) {
//                $this->s->set($varName, $varValue);
//                return $this->redirect('/altar/page7');
//            }
//        }
//        return $this->returnRender($varName);
//    }

    public function actionPage7()
    {
        $varName = 'page7';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/verx');
            }
        }
        return $this->returnRender($varName);
    }

    public function actionVerx()
    {
        $varName = 'verx';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/title');
            }
        }
        return $this->returnRender($varName);
    }

    public function actionTitle()
    {
        $varName = 'title';
                $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                $this->s->set('title_color_type', $_POST['color_t']);
                return $this->redirect('/altar/page11');
            }
        }

        return $this->returnRender($varName);
    }

    public function actionPage11()
    {
        $varName = 'page11';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            $varValue1 = $request->post($varName.'_1', 0);
            $varValue2 = $request->post($varName.'_2', 0);
            $varValue3 = $request->post($varName.'_3', 0);
            $varValue4 = $request->post($varName.'_4', 0);
            $varValue5 = $request->post($varName.'_5', 0);

            $this->s->set($varName.'_1', $varValue1);
            $this->s->set($varName.'_2', $varValue2);
            $this->s->set($varName.'_3', $varValue3);
            $this->s->set($varName.'_4', $varValue4);
            $this->s->set($varName.'_5', $varValue5);

            return $this->redirect('/altar/sign');
        }

        return $this->returnRender($varName);
    }

    public function actionSign()
    {
        $varName = 'sign';
        $request = Yii::$app->request;
        if ( $request->isPost ) {
            if ( $varValue = $request->post($varName, 0) ) {
                $this->s->set($varName, $varValue);
                return $this->redirect('/altar/pdf');
            }
        }
        $model = $this->findModel(2);
//        var_dump($model);
//        die();
        if ( $model ) {
            return $this->returnRender($varName, $model);
        } else {
            return $this->returnRender($varName);
        }
    }

    /**
     * Finds the Googleforms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Googleforms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Googleforms::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
//            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionPdf()
    {

        $vars = $this->getValues();
        //var_dump($vars);
//        die();

        // Берем параметры из сессии
        $clientId = $this->s->get('client_id');
        $clientName = $this->s->get('client_name');

        $signFilePath='';
        // Сохраняем подпись если передана
//        if (isset($_FILES['signature_img']['tmp_name'])) {
//            $signFileName = $clientId . "_" . time() . "_" . rand(383, 1000);
//            $signFilePath = '../../_result.signs.cache/' . $signFileName . '.png';
//            // Запихиваем подпись из поста в файл
//            move_uploaded_file($_FILES['signature_img']['tmp_name'], $signFilePath);
//        }

        //табличка с последним заполненым фомой этогокдиента готовм
        //отсортированф по алфавиту - берем последний
//        $filename = '';
//        foreach (glob("../../_result.json.cache/" . $clientId . "_*") as $filename) {
//        }
//        if (!$filename) {
//            return "No Google Form result";
//        }
//        $my_json_in = json_decode(file_get_contents($filename), true);
//        $form_rows = $my_json_in[0];
        // здесь данные из базы по нашей ФОРМЕ
        // здесь данные из базы по нашей ФОРМЕ
        // здесь данные из базы по нашей ФОРМЕ
//        $form_fields_from_db = $my_json_in[1];
        $form_fields_from_db['name'] = 'ALTAR';
        $form_fields_from_db['internal_emails'] = 'ruslan.novikov@gmail.com;rlopatkin@gmail.com;l_rom@mail.ru;sergei.epshtein@gmail.com';
        $form_fields_from_db['internal_message'] = 'Message';
        $form_fields_from_db['mfiles_meta_class_id'] = 10;
        $form_fields_from_db['mfiles_meta_dropdwn_001_id'] = 10;
        $form_fields_from_db['mfiles_meta_dropdwn_002_id'] = 10;

        // Преобразовываем тип
        $originType = $this->s->get('type');
        if (in_array($originType, [1,2])) {
            $type = 1;
        } else {
            $type = 2;
        }

        // Чертеж
        if ($vars['type']=='4' && $vars['verx']=='3') {
//            $chert = 'altar_dim1_2.png';
            $chert = 'from_pdf/1.png';
        } elseif ($vars['type']=='3' && $vars['cornice']=='1'  && $vars['verx']!='3') {
//            $chert = 'altar_dim2_1.png';
            $chert = 'from_pdf/2.png';
        } elseif (($vars['type']=='1' || $vars['type']=='4') && $vars['cornice']=='2'  && $vars['verx']!='3') {
//            $chert = 'altar_dim2_2.png';
            $chert = 'from_pdf/3.png';
        } elseif ($vars['type']=='2' && $vars['cornice']=='1'  && $vars['verx']!='3') {
//            $chert = 'altar_dim2_1.png';
            $chert = 'from_pdf/4.png';
        }elseif (($vars['type']=='1' || $vars['type']=='4') && $vars['cornice']=='2'  && $vars['verx']!='3') {
//            $chert = 'altar_dim2_2.png';
            $chert = 'from_pdf/5.png';
        }elseif ($vars['type']=='2' && $vars['cornice']=='2'  && $vars['verx']=='3') {
//            $chert = 'altar_dim2_2.png';
            $chert = 'from_pdf/6.png';
        }elseif ($vars['type']=='2' && $vars['cornice']=='1'  && $vars['verx']=='3') {
//            $chert = 'altar_dim2_2.png';
            $chert = 'from_pdf/7.png';
        }else{
//            $chert = 'altar_dim2_2.png';
            $chert = 'from_pdf/8.png';
        }
        $content = '<table width="800px;" border="0"><tr><td style="text-align:center;"><img src="./_altar/1/'.$chert.'" style="width:700px;"></td></tr></table><br/><br/><br/><br/><br/><br/>';

        // Сборка из выбранных элементов

        // Цвет и тип
        $color = $this->s->get('color');
        $img1Name = './_altar/1/alt_type/altar'.$originType.'_'.$color.'.png';
        $img1 = @imagecreatefrompng($img1Name);

        // Корниз
        $cornice = $this->s->get('cornice');
        $title = $this->s->get('title');
        $img2Name = null;

        $title_color_type = '';
        if($vars['title_color_type']=='2')
            $title_color_type = '_c';
        if ($cornice==1) {
            if ( $title == 11 ) {
            } else {
                $img2Name = './_altar/1/alt_cornice/alt_cornice'.$title_color_type.'1_'.$type.'_'.$color.'.png';
            }
        } else {
            if ( $title == 11 ) {
                $img2Name = './_altar/1/alt_cornice/alt_cornice2_'.$type.'_'.$color.'.png';
            } else {
                $img2Name = './_altar/1/alt_cornice/alt_cornice'.$title_color_type.'3_'.$type.'_'.$color.'.png';
            }
        }
        if ( $img2Name ) {
            $img2 = @imagecreatefrompng($img2Name);
            imagecopy($img1, $img2, 0, 0, 0, 0, 1500, 1500);
        }

        // Дверь
        $door = $this->s->get('door');
        $img3Name = './_altar/1/alt_door/alt_door'.$door.'_'.$type.'_'.$color.'.png';
        $img3 = @imagecreatefrompng($img3Name);
        imagecopy($img1, $img3, 0, 0, 0, 0, 1500, 1500);

        // Фриз
        $freize = $this->s->get('freize');
        if (($color == 1) || ($color == 2)) {
            if ($freize == 1) {
                $img4Name = './_altar/1/alt_freize_che/alt_freize_che'.$type.'.png';
            }
            elseif (in_array($freize, array(2,3,4))) {
                $img4Name = './_altar/1/alt_freize_rez/alt_freize_rez'.$freize.'_'.$type.'_'.$color.'.png';
            }
            elseif (in_array($freize, array(5,6,7,8,9,10,11,12,13,14,15,16))) {
                if ($freize == 5) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz1_1_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 6) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz1_2_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 7) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz1_3_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 8) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz1_4_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 9) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz2_1_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 10) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz2_2_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 11) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz2_3_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 12) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz2_4_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 13) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz3_1_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 14) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz3_2_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 15) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz3_3_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 16) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz3_4_'.$type.'_'.$color.'.png';
                }
            }
        } else {
            if ($freize == 1) {
                $img4Name = './_altar/1/alt_freize_che/alt_freize_che'.$type.'.png';
            }
            elseif (in_array($freize, array(2,3,4))) {
                $img4Name = './_altar/1/alt_freize_rez/alt_freize_rez'.$freize.'_'.$type.'_'.$color.'.png';
            }
            elseif (in_array($freize, array(5,6,7,8,9,10))) {
                if ($freize == 5) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz1_1_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 6) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz1_2_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 7) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz2_1_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 8) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz2_2_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 9) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz3_1_'.$type.'_'.$color.'.png';
                }
                elseif ($freize == 10) {
                    $img4Name = './_altar/1/alt_freize_laz/alt_freize_laz3_2_'.$type.'_'.$color.'.png';
                }
            }
        }
        $img4 = @imagecreatefrompng($img4Name);
        imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);

        // Верх
        $verx = $this->s->get('verx');
        if ( $verx != 3) {
            if ( $verx == 1) {
                $img5Name = './_altar/1/alt_verx_che/alt_verx_che'.$cornice.'_'.$type.'_'.$color.'.png';
            } else {
                $img5Name = './_altar/1/alt_verx_rez/alt_verx_rez'.$cornice.'_'.$type.'_'.$color.'.png';
            }

            $img5 = @imagecreatefrompng($img5Name);

            imagecopy($img1, $img5, 0, 0, 0, 0, 1500, 1500);

        } else {
            $img5Name = '';
        }

        // Размеры
        if ($originType == 4) {
            $img6Name = "./_altar/1/alt_dimentions/altar_dim1_2.png";
        } elseif ($originType == 3) {
            $img6Name = "./_altar/1/alt_dimentions/altar_dim2_1.png";
        } elseif ($originType == 2) {
            $img6Name = "./_altar/1/alt_dimentions/altar_dim2_2.png";
        } else {
            $img6Name = "./_altar/1/alt_dimentions/altar_dim1_2.png";
        }
        $img6 = @imagecreatefrompng($img6Name);
        imagecopy($img1, $img6, 0, 0, 0, 0, 1500, 1500);

        // Сохраняем собранную картинку
        $fileName = $clientId . "_" . time() . "_" . rand(383, 1000);
        $imgFilePath = '../../_img.cache/' . $fileName . '.png';
//        header('Content-Type: image/gif');
        imagegif($img1, $imgFilePath);
//        die();

        // Сгенеренную картинку вставляем в контент спецификации
        $content .= '<table style="width:700px;"><tr><td style="text-align:center;">'
                . '<br/><br/><br/><br/><br/><br/><br/><div style="font-family: freesans;font-size: 25px;">גוון הארון, פסוק בכותרת, אומנות צד ואומנות עליונה הינם ע"פ המפרט. ההדמיה להמחשה בלבד</div>'
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
        $p2 = $this->s->get('page2');
        switch ( $p2 ) {
            case 1:
                $descriptionPage2 = 'ארון קודש דגם דביר, עם כיס פרוכת, קרניז נמוך';
                break;
            case 2:
                $descriptionPage2 = 'ארון קודש דגם דביר, עם כיס פרוכת, קרניז גבוה';
                break;
            case 3:
                $descriptionPage2 = 'ארון קודש דגם דביר, עם כיס פרוכת, קרניז נמוך, אומנות עליונה ';
                break;
            case 4:
                $descriptionPage2 = 'ארון קודש דגם דביר, עם כיס פרוכת, קרניז גבוה, אומנות עליונה';
                break;
            case 5:
                $descriptionPage2 = 'ארון קודש דגם דביר, ללא כיס פרוכת, קרניז גבוה, אומנות עליונה';
                break;
            case 6:
                $descriptionPage2 = 'ארון קודש דגם דביר, ללא כיס פרוכת, קרניז גבוה';
                break;
            case 7:
                $descriptionPage2 = 'ארון קודש דגם דביר, ללא כיס פרוכת, קרניז נמוך';
                break;
            case 8:
                $descriptionPage2 = 'ארון קודש דגם דביר, ללא כיס פרוכת, קרניז נמוך, אומנות עליונה';
                break;
            case 9:
                $descriptionPage2 = 'ארון קודש דגם דביר נמוך, עם כיס פרוכת, קרניז נמוך';
                break;
            case 10:
                $descriptionPage2 = 'ארון קודש דגם דביר נמוך, עם כיס פרוכת, קרניז גבוה';
                break;
            case 11:
                $descriptionPage2 = 'ארון קודש דגם דביר נמוך, עם כיס פרוכת, קרניז נמוך, אומנות עליונה';
                break;
            case 12:
                $descriptionPage2 = 'ארון קודש דגם דביר נמוך, עם כיס פרוכת, קרניז גבוה, ';
                break;
            case 13:
                $descriptionPage2 = 'ארון קודש דגם דביר נמוך, ללא כיס פרוכת, קרניז גבוה';
                break;
            case 14:
                $descriptionPage2 = 'ארון קודש דגם דביר נמוך, ללא כיס פרוכת, קרניז נמוך';
                break;
            case 15:
                $descriptionPage2 = 'ארון קודש דגם דביר נמוך, ללא כיס פרוכת, קרניז נמוך, אומנות עליונה';
                break;
            case 16:
                $descriptionPage2 = 'ארון קודש דגם דביר נמוך, ללא כיס פרוכת, קרניז גבוה, אומנות עליונה';
                break;
        }

        // Цвет со страницы 3
        /*$rows[] = array(
            '0' => './_altar/1/alt_color/wood' . $this->s->get('color') . '.jpg',
            '1' => 'Color #' . $color,
        );*/
        // Цвет со страницы 4
        $page4 = $this->s->get('page4');
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
        // Карниз
//        $rows[] = array(
//            '0' => $img2Name,
//            '1' => 'Cornice #' . $cornice,
//        );
        // Двери
//        $description = '';
//        switch ( $originType ) {
//            case 1:
//                $description = 'דלתות מחורצות';
//                break;
//            case 2:
//                $description = 'דלתות עם סרגלי קישוט';
//                break;
//            case 3:
//                $description = 'דלתות חלקות';
//                break;
//        }
//        $rows[] = array(
//            '0' => $img3Name,
//            '1' => $description,
//        );

        // Фриз
        $freize = $this->s->get('freize');
        if ( ($color == 1) || ($color == 2) ) {

            switch ( $originType ) {
                case 1:
                    $description = 'ריקוע גפן';
                    break;
                case 2:
                    $description = "גילוף קשתות";
                    break;
                case 3:
                    $description = "גילוף גפן";
                    break;
                case 4:
                    $description = "גילוף שיבולים";
                    break;
                case 5:
                    $description = "לייזר מגיני דוד זהב";
                    break;
                case 6:
                    $description = "לייזר מגיני דוד כסף";
                    break;
                case 7:
                    $description = "לייזר מגיני דוד חום בהיר";
                    break;
                case 8:
                    $description = "לייזר מגיני דוד חום כהה";
                    break;
                case 9:
                    $description = "לייזר רימונים זהב";
                    break;
                case 10:
                    $description = "לייזר רימונים כסף";
                    break;
                case 11:
                    $description = "לייזר רימונים חום בהיר";
                    break;
                case 12:
                    $description = "לייזר רימונים חום כהה";
                    break;
                case 13:
                    $description = "לייזר גפן זהב";
                    break;
                case 14:
                    $description = "לייזר גפן כסף";
                    break;
                case 15:
                    $description = "לייזר גפן חום בהיר";
                    break;
                case 16:
                    $description = "לייזר גפן חום כהה";
                    break;
            }

        } else {

            switch ( $originType ) {
                case 1:
                    $description = 'ריקוע גפן';
                    break;
                case 2:
                    $description = "גילוף קשתות";
                    break;
                case 3:
                    $description = "גילוף גפן";
                    break;
                case 4:
                    $description = "גילוף שיבולים";
                    break;
                case 5:
                    $description = "לייזר מגיני דוד זהב";
                    break;
                case 6:
                    $description = "לייזר מגיני דוד כסף";
                    break;
                case 7:
                    $description = "לייזר רימונים זהב";
                    break;
                case 8:
                    $description = "לייזר רימונים כסף";
                    break;
                case 9:
                    $description = "לייזר גפן זהב";
                    break;
                case 10:
                    $description = "לייזר גפן כסף";
                    break;
            }
        }
        $rows[] = array(
            '0' => $img4Name,
            '1' => $description,
        );

        // Page7
        $p7 = $this->s->get('page7');
        if ($p7 == 1) {
            $f = './_altar/1/alt_page7/blue.png';
            $description = 'חיפוי פנים לבד כחול';
        } elseif ( $p7 == 2 ) {
            $f = './_altar/1/alt_page7/red.png';
            $description = 'חיפוי פנים לבד אדום';
        } else {
            $f = '';
            $description = 'Page7';
        }
        $rows[] = array(
            '0' => $f,
            '1' => $description,
        );

        // Верхнее украшение
        if ( $verx == 3 ) {
            $description = 'אומנות עליונה';
        } else {
            $description = 'אומנות עליונה'.' #'.$verx;
        }
        $rows[] = array(
            '0' => $img5Name,
            '1' => $description,
        );

        //цвет надписи
        $color_title = 'זהב';
        if($this->s->get('title_color_type')==2)
            $color_title = 'כסף';


        // Надпись
        if ( $this->s->get('title') == 11 ) {
            $rows[] = array(
                '0' => '',
                '1' => 'פסוק',
            );
        } else {
            $rows[] = array(
                '0' => './_altar/1/alt_title/nadpis' . $this->s->get('title') . '.png',
                '1' => 'פסוק'.' #'.$this->s->get('title').' '.$color_title,
            );
        }

        // Тексты со страницы 11
        $p11_1 = $this->s->get('page11_1');
        $t11_1 = 'נייד(על גלגלים)';
        $d11_1 = ($p11_1==1)?'לא':'כן';

        $p11_2 = $this->s->get('page11_2');
        $d11_2 = ($p11_2==1)?'לא':'כן';
        $t11_2 = 'מיגון פח הקפי';

        $p11_3 = $this->s->get('page11_3');
        $d11_3 = ($p11_3==1)?'לא':'כן';
        $t11_3 = 'מיגון סורג טרילידור';

        $p11_4 = $this->s->get('page11_4');
        $d11_4 = ($p11_4==1)?'לא':'כן';
        $t11_4 = 'מחיצות פנים (לספרים אשכנזים)';

        $p11_5 = $this->s->get('page11_5');
        $t11_5 = 'סוג עץ ופורניר';
        if ( $p11_5 == 1) {
            $d11_5 = 'מהגוני';
        } else {
            $d11_5 = 'אחר ע"פ המפרט';
        }


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

        // Текст со страницы 2
       // $content .= "<tr><td align='right' style='font-family: freesans'>" . $descriptionPage2 . "</td>
        //    <td align='right' style='width: 300px;font-family: freesans'>ארון קודש דגם דביר- נספח שרטוטים</td></tr>";

        // Текст со страницы 11
        $content .= "<tr><td align='right' style='font-family: freesans'>" . $t11_1 . "</td>
            <td align='right' style='width: 300px;font-family: freesans'>" . $d11_1 . "</td></tr>";
        $content .= "<tr><td align='right' style='font-family: freesans'>" . $t11_2 . "</td>
            <td align='right' style='width: 300px;font-family: freesans'>" . $d11_2 . "</td></tr>";
        $content .= "<tr><td align='right' style='font-family: freesans'>" . $t11_3 . "</td>
            <td align='right' style='width: 300px;font-family: freesans'>" . $d11_3 . "</td></tr>";
        $content .= "<tr><td align='right' style='font-family: freesans'>" . $t11_4 . "</td>
            <td align='right' style='width: 300px;font-family: freesans'>" . $d11_4 . "</td></tr>";
        $content .= "<tr><td align='right' style='font-family: freesans'>" . $t11_5 . "</td>
            <td align='right' style='width: 300px;font-family: freesans'>" . $d11_5 . "</td></tr>";

        // Описание
        $content .= "<tr><td align='right' style='font-family: freesans'>הערות</td>
            <td align='right' style='width: 300px;font-family: freesans'>" . $this->s->get('sign') . "</td></tr>";

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

        ////////////////////////////
        $mfiles = new Mfiles();
        $mfiles->extantion = 'pdf';
        // имя файла upload
        $fileNameMfiles = $clientName . '_altar_' . date('Y-m-d') . "__at__" . date('H-i-s');
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

           /* foreach ($d[1] as $email) {
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

        return $this->render('pdf-result', $this->getValues());
    }

}
