<?php
namespace frontend\controllers;

use frontend\models\Mfiles;
use kartik\mpdf\Pdf;
use Yii;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class CabinetController extends Controller
{


    public function beforeAction($action)
    {
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionType()
    {
        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');

        if (!$client_id) {
            return $this->redirect("/site/client");
            return true;
        }

        // защищенные от JS куки
        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        if (isset($_POST['type'])) {
            return $this->redirect( "/cabinet/placement-0-0-0?type=" . $_POST['type'] );
        }

        return $this->render('type', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }

    public function actionPlacement000($type)
    {
        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');


        if (!$client_id) {
            return $this->redirect("/site/client");
            return true;
        }

        // защищенные от JS куки
        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet000.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);


        // ХЕРАЧИМ ИСТОРИЮ ПРЕДЫДЫУЩИХ ВЫБОРОВ
        setcookie('placement', '', time() + 180000);
        setcookie('typecapitel', '', time() + 180000);
        setcookie('typecabinet', '', time() + 180000);
        setcookie('colorcabinet', '', time() + 180000);
        setcookie('imgnuminlist_colorcabinet', '', time() + 180000);
        setcookie('numsections', '', time() + 180000);
        setcookie('typecornice', '', time() + 180000);
        setcookie('imgnuminlist_cornice', '', time() + 180000);
        setcookie('typefrieze', '', time() + 180000);
        setcookie('imgnuminlist_frieze', '', time() + 180000);
        setcookie('shelmounting_type', '', time() + 180000);
        setcookie('type_door', '', time() + 180000);
        setcookie('color_door', '', time() + 180000);
        setcookie('imgnuminlist_door', '', time() + 180000);
        setcookie('type_handle', '', time() + 180000);
        setcookie('color_handle', '', time() + 180000);
        setcookie('imgnuminlist_handle', '', time() + 180000);
        setcookie('comment_with_alcove', '', time() + 180000);
        setcookie('comment_not_standart', '', time() + 180000);
        setcookie('alcovemounting_type', '', time() + 180000);
        setcookie('decor_position', '', time() + 180000);

        if (isset($_POST['placement'])) {

//            print_r($_POST);
            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);
            // НЕ защищенные от JS куки
           // if (!$_POST['placement'])
          //      die('No $_POST placement');
            //
           // setcookie('comment_not_standart', $_POST['comment_not_standart'], time() + 180000);
           // setcookie('comment_with_alcove', $_POST['comment_with_alcove'], time() + 180000);
            setcookie('placement', $_POST['placement'], time() + 180000);
            setcookie('typecabinet', $type, time() + 180000);


           // if ($_POST['placement'] == 'with_alcove') {
           //     return $this->redirect('/cabinet/placement-0-0-1?type=' . $type);
           // } else {
                // $type - езе не соепредеоен клиентми в кукеисы н сохранен
                return $this->redirect('/cabinet/color-0-0-1?type=' . $type);
         //   }

//            // если впрошлой жизни выбирали цвет двери - он может мешать в определении цвета ручки если ткт у этих двух типо вмебели нет двееой
//            setcookie('type_door', '', time() + 180000);
//            setcookie('color_door', '', time() + 180000);
//            setcookie('imgnuminlistdoor', '', time() + 180000);
//            unset($_COOKIE['type_door']);
//            unset($_COOKIE['color_door']);
//            unset($_COOKIE['imgnuminlistdoor']);
//
//
//            // только 2 4 5 типы шкафов выбирают двери
//            if (in_array($_COOKIE['typecabinet'], [2, 4, 5]))
//                return $this->redirect('/cabinet/doors-0-0-3', 301);
//            // есть только верхня дверь и верхняя ручка
//            else if (in_array($_COOKIE['typecabinet'], [1, 6])) {
//                //
//                return $this->redirect('/cabinet/handles-0-0-4', 301);
//            } // мимо дверей и ручек
//            else if (in_array($_COOKIE['typecabinet'], [3]))
//                return $this->redirect('/cabinet/shelmounting-0-0-5', 301);
//
//
        }

//        print_r($_COOKIE);
//        exit;

        return $this->render('placement-0-0-0', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }

    public function actionPlacement001($type)
    {
        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
            return true;
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

//        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
//        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
//        $this->view->registerJsFile('/js/colorselect_cabinet005.js', ['position' => \yii\web\View::POS_HEAD]);
//        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['alcovemounting_type'])) {

            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);
            // НЕ защищенные от JS куки
            setcookie('alcovemounting_type', $_POST['alcovemounting_type'], time() + 180000);

            return $this->redirect('/cabinet/color-0-0-1?type=' . $type);

        }

        return $this->render('placement-0-0-1', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }


    // только для тображения шкафов без инструментов
    public function actionAjax000()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }


        // специально разложено отдельными блоками
        // т.к. затем внутри будут добавляться разные идивидуальеые условия
        // кто с кем может паролваться и на каких условиях
        //


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';


        // один определенный рамера цвета и типа
        //foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png") as $file) {
        foreach (glob("./_cabinet/" . $id . "/bookcase/*.png") as $file) {
            $files['bookcase'][] = $file;
        }

        if (!isset($files)) {
            die("не нашел мебели по запросу ./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png");
        }


        foreach (glob("./_cabinet/" . $id . "/border/*.png") as $file) {
            $files['border'][] = $file;
        }
        foreach (glob("./_cabinet/" . $id . "/cornice/*.png") as $file) {
            $files['cornice'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            $files['door'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/frieze/*.png") as $file) {
            $files['frieze'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            $files['handledown'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            $files['handleup'][] = $file;
        }


        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handledown
         * handleup
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handledown['title'] = 'handledown';
        foreach ($files['handledown'] as $fimg) {
            $handledown['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handleup['title'] = 'handleup';
        foreach ($files['handleup'] as $fimg) {
            $handleup['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }


        $list = [
//            'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",
            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handledown,
            'type7' => $handleup,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }


    public function actionColor001()
    {


        $type = $_COOKIE['typecabinet'];

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
            return true;
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet001.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {

            //print_r($_POST);
            // возвращает только порядоквый номер файла
            // вся полезная инфа внтури файла
            // т.к. аякс может быть измнен и порядок имзенится
            //надо брать из первоисточника
            // сюда ка книстранно куик не передаются ;)
            if (!isset($_COOKIE['numsections'])) {
                setcookie('numsections', 1, time() + 180000);
                $_COOKIE['numsections'] = 1;
            }

            $a = file_get_contents('http://admin:5124315@lavi.new-dating.com/cabinet/ajax-0-0-1?typecabinet=' . $type . '&id=' . $_COOKIE['numsections'] . '&action=get_colors');
            $b = json_decode($a, true);
            // оенивый юзверь галочку не передвинул и в форме пока пуст -п о дефолту первую аглоку передаем


            if ($_POST['order']['color_type1'] == 0) $_POST['order']['color_type1'] = 1;
            if (!isset($b['kitchen_1']['type1']['image' . $_POST['order']['color_type1']]['layer'])) die('Pls. get select need param on this step');
            preg_match('~([0-9]+_[0-9]+_[0-9]+).png~', $b['kitchen_1']['type1']['image' . $_POST['order']['color_type1']]['layer'], $d);
            $result = explode('_', $d[1]);
//            echo " type".$result[0];
//            echo " color".$result[2];
//            exit;
            // запоминаем только цвет
            // колиечство секций ($id) группы шкафов на следующем шаге
            // тут важен ЦВЕТ и ТИП для следующих выборок
//            SiteController::setTagCookies('typecabinet', $result[0]);
//            SiteController::setTagCookies('colorcabinet', $result[2]);

            if (!$result[0])
                die('No $result[0]');
            if (!$result[2])
                die('No $result[2]');

            // НЕ защищенные от JS куки
            setcookie('typecabinet', $result[0], time() + 180000);
            setcookie('colorcabinet', $result[2], time() + 180000);
            // сохраним порядоковы йномер картинки - нам потом ее доставать надо
            setcookie('imgnuminlist_colorcabinet', $_POST['order']['color_type1'], time() + 180000);
            return $this->redirect('/cabinet/count-0-0-2', 301);
        }

        return $this->render('color-0-0-1', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }


    public function actionAjax001()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }


        // специально разложено отдельными блоками
        // т.к. затем внутри будут добавляться разные идивидуальеые условия
        // кто с кем может паролваться и на каких условиях
        //
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {
            $files['bookcase'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/border/*.png") as $file) {
            $files['border'][] = $file;
        }
        foreach (glob("./_cabinet/" . $id . "/cornice/*.png") as $file) {
            $files['cornice'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            $files['door'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/frieze/*.png") as $file) {
            $files['frieze'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            $files['handledown'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            $files['handleup'][] = $file;
        }


        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handledown
         * handleup
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handledown['title'] = 'handledown';
        foreach ($files['handledown'] as $fimg) {
            $handledown['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handleup['title'] = 'handleup';
        foreach ($files['handleup'] as $fimg) {
            $handleup['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }


        $list = [
            'background' => trim($files['bookcase'][0], '.'),
            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handledown,
            'type7' => $handleup,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }


    public function actionCount002()
    {
        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');

        if (!$client_id) {
            return $this->redirect("/site/client");
            return true;
        }

        // защищенные от JS куки
        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet002.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {

//            print_r($_POST);
            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);
            // НЕ защищенные от JS куки
            if (!$_POST['number_sections'])
                die('No $_POST number_sections');
            //
            setcookie('numsections', $_POST['number_sections'], time() + 180000);
//            setcookie('typecabinet', $type, time() + 180000);


            /**
             * [type_alcove] => no_alcove
             * [number_sections] => 1
             * [wa_l] =>
             * [wa_n] =>
             * [ns_l] =>
             * [ns_b] =>
             * [ns_h] =>
             *
             */


            return $this->redirect('/cabinet/carnice-0-0-7', 301);


            // если впрошлой жизни выбирали цвет двери - он может мешать в определении цвета ручки если ткт у этих двух типо вмебели нет двееой
            setcookie('type_door', '', time() + 180000);
            setcookie('color_door', '', time() + 180000);
            setcookie('imgnuminlistdoor', '', time() + 180000);
            unset($_COOKIE['type_door']);
            unset($_COOKIE['color_door']);
            unset($_COOKIE['imgnuminlistdoor']);


            // только 2 4 5 типы шкафов выбирают двери
            if (in_array($_COOKIE['typecabinet'], [2, 4, 5]))
                return $this->redirect('/cabinet/doors-0-0-3', 301);
            // есть только верхня дверь и верхняя ручка
            else if (in_array($_COOKIE['typecabinet'], [1, 6])) {
                //
                return $this->redirect('/cabinet/handles-0-0-4', 301);
            } // мимо дверей и ручек
            else if (in_array($_COOKIE['typecabinet'], [3]))
                return $this->redirect('/cabinet/shelmounting-0-0-5', 301);
        }

//        print_r($_COOKIE);
//        exit;

        return $this->render('count-0-0-2', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }


    // только для тображения шкафов без инструментов
    public function actionAjax002()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        // специально разложено отдельными блоками
        // т.к. затем внутри будут добавляться разные идивидуальеые условия
        // кто с кем может паролваться и на каких условиях
        //


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';


        // один определенный рамера цвета и типа
        //foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png") as $file) {
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {
            //  foreach (glob("./_cabinet/" . $id . "/bookcase/*.png") as $file) {
            $files['bookcase'][] = $file;
        }

        if (!isset($files)) {
            die("не нашел мебели по запросу ./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png");
        }


        foreach (glob("./_cabinet/" . $id . "/border/*.png") as $file) {
            $files['border'][] = $file;
        }
        foreach (glob("./_cabinet/" . $id . "/cornice/*.png") as $file) {
            $files['cornice'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            $files['door'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/frieze/*.png") as $file) {
            $files['frieze'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            $files['handledown'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            $files['handleup'][] = $file;
        }


        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handledown
         * handleup
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handledown['title'] = 'handledown';
        foreach ($files['handledown'] as $fimg) {
            $handledown['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handleup['title'] = 'handleup';
        foreach ($files['handleup'] as $fimg) {
            $handleup['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }


        $list = [
//            'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",
            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handledown,
            'type7' => $handleup,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }


    public function actionDoors003()
    {

        $type = $_COOKIE['typecabinet'];


        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet003.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {

            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);
            // НЕ защищенные от JS куки


            // ДЛЯ ТИПА ШКАФА 3 и 5 вродн  - двери ОТСУСТВУЮТ но ручки есть!!!

            $a = file_get_contents('http://admin:5124315@lavi.new-dating.com/cabinet/ajax-0-0-3?typecabinet=' . $type . 'id=' . $_COOKIE['numsections'] . '&typecabinet=' . $_COOKIE['typecabinet'] . '&colorcabinet=' . $_COOKIE['colorcabinet'] . '&action=get_colors');
            $b = json_decode($a, true);

//            print_r($_POST['order']);

            // двери только тут
            if (in_array($type, [2, 4, 5])) {
                // сюда ка книстранно куик не передаются ;)
//                if ($_POST['order']['color_type4'] == 0) $_POST['order']['color_type4'] = 1;
                if (!isset($b['kitchen_1']['type4']['image' . $_POST['order']['color_type4']]['layer'])) die('Pls. get select need param on this step');
                preg_match('~([0-9]+_[0-9]+_[0-9]+).png~', $b['kitchen_1']['type4']['image' . $_POST['order']['color_type4']]['layer'], $d);
                $result = explode('_', $d[1]);
                // запоминаем только цвет
                // колиечство секций ($id) группы шкафов на следующем шаге
                // тут важен ЦВЕТ и ТИП для следующих выборок
//            SiteController::setTagCookies('typecabinet', $result[0]);
//            SiteController::setTagCookies('colorcabinet', $result[2]);
                // НЕ защищенные от JS куки
                setcookie('type_door', $result[0], time() + 180000);
                setcookie('color_door', $result[2], time() + 180000);
                setcookie('imgnuminlist_door', $_POST['order']['color_type4'], time() + 180000);
            }

            // руки только тут
            if (in_array($type, [2, 4, 5, 1, 6])) {
                // сюда ка книстранно куик не передаются ;)
//                if ($_POST['order']['color_type4'] == 0) $_POST['order']['color_type4'] = 1;
                if (!isset($b['kitchen_1']['type6']['image' . $_POST['order']['color_type6']]['layer'])) die('Pls. get select need param on this step');
                preg_match('~([0-9]+_[0-9]+_[0-9]+).png~', $b['kitchen_1']['type6']['image' . $_POST['order']['color_type6']]['layer'], $d);
                $result = explode('_', $d[1]);
                // запоминаем только цвет
                // колиечство секций ($id) группы шкафов на следующем шаге
                // тут важен ЦВЕТ и ТИП для следующих выборок
//            SiteController::setTagCookies('typecabinet', $result[0]);
//            SiteController::setTagCookies('colorcabinet', $result[2]);
                // НЕ защищенные от JS куки
                setcookie('type_handle', $result[0], time() + 180000);
                setcookie('color_handle', $result[2], time() + 180000);
                setcookie('imgnuminlist_handle', $_POST['order']['color_type6'], time() + 180000);
            }


            //
            return $this->redirect('/cabinet/final-0-0-9', 301);

        }

        return $this->render('doors-0-0-3', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }


    public function actionAjax003()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');

        $files['decor'] = [];
        $files['door'] = [];
        $files['border'] = [];

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';


        // специально разложено отдельными блоками
        // т.к. затем внутри будут добавляться разные идивидуальеые условия
        // кто с кем может паролваться и на каких условиях
        //
//        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $type . "_*.png") as $file) {
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {
            $files['bookcase'][] = $file;
        }


        foreach (glob("./_cabinet/" . $id . "/border/*_" . $_GET['colorcabinet'] . ".png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~border1_~', $file))
                        $files['border'][] = $file;
                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~border3_~', $file))
                        $files['border'][] = $file;
                    break;
            }
        }


        foreach (glob("./_cabinet/" . $id . "/door/*" . $_GET['colorcabinet'] . ".png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 4:
                    //только 3 4
                    if (preg_match('~door[3-4]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 5:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
            }
        }


        //
        $n_kapitel = '';
        if(isset($_COOKIE['typecapitel']) && $_COOKIE['typecapitel']!='none')
            $n_kapitel = 'k';

        foreach (glob("./_cabinet/" . $id . "/cornice/cornice{1,4,5}".$n_kapitel."_".$id."_" . $_GET['colorcabinet'] . ".png", GLOB_BRACE) as $file) {
            $files['cornice'][] = $file;
        }

        // тут кто с кем https://docs.google.com/document/d/1HicF2asaCef43XjRRU9E6AqpxTujsoDO1IO0RiSAAkk/edit?ts=5826e864
        foreach (glob("./_cabinet/" . $id . "/frieze/*_" . $_GET['colorcabinet'] . ".png", GLOB_BRACE) as $file)
        {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;
                    break;
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[4-6]{1}_~', $file)
                        OR preg_match('~frieze1[0-1]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze7[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 5:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
            }
        }

        // ручки из двух разных папок
        // ручки из двух разных папок
        // ручки из двух разных папок
        $files['handle'] = [];
        $handle_color = (isset($_GET['color_door']) AND $_GET['color_door'] <> '*') ? $_GET['color_door'] : $_GET['colorcabinet'];
        foreach (glob("./_cabinet/" . $id . "/handledown/*_" . $_GET['colorcabinet'] . ".png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2://1-6
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 4://7-12
                    if (preg_match('~handledown[7-9]{1}_.*_' . $handle_color . '~', $file) OR preg_match('~handledown1[0-2]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 5:
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }

//        echo '~_.*_' . $handle_color . '~';
//        exit;

        foreach (glob("./_cabinet/" . $id . "/handleup/*_" . $_GET['colorcabinet'] . ".png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }


        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handledown
         * handleup
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $decor['title'] = 'decor';
        foreach ($files['decor'] as $fimg) {
            $decor['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handle['title'] = 'handle';
        foreach ($files['handle'] as $fimg) {
            $handle['image' . ++$i] = [
                'color' => '/_cabinet/handle/handle'.$i.'.png',
                'layer' => trim($fimg, '.')
            ];
        }

//        $i = 0;
//        $handleup['title'] = 'handleup';
//        foreach ($files['handleup'] as $fimg) {
//            $handleup['image' . ++$i] = [
//                'color' => '/_furniture/images/bottom.png',
//                'layer' => trim($fimg, '.')
//            ];
//        }


        $list = [
            //'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",

            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handle,
            'type7' => $decor,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }


    public function ___actionHandles004()
    {

        $type = $_COOKIE['typecabinet'];

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
            return true;
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet004.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {

            //print_r($_POST);
            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);

            // чтобы не сбивать алгоритм - подменим цвет вирутальных дверей цветм шкафа
            if (!isset($_COOKIE['type_door'])) $_COOKIE['type_door'] = $_COOKIE['typecabinet'];
            if (!isset($_COOKIE['color_door'])) $_COOKIE['color_door'] = $_COOKIE['colorcabinet'];
            // сюда ка книстранно куик не передаются ;)
            $a = file_get_contents('http://admin:5124315@lavi.new-dating.com/cabinet/ajax-0-0-4?typecabinet=' . $type . 'id=' . $_COOKIE['numsections']
                . '&typecabinet=' . $_COOKIE['typecabinet']
                . '&colorcabinet=' . $_COOKIE['colorcabinet']
                . '&type_door=' . $_COOKIE['type_door']
                . '&color_door=' . $_COOKIE['color_door']
                . '&action=get_colors');
            $b = json_decode($a, true);
            if ($_POST['order']['color_type6'] == 0) $_POST['order']['color_type6'] = 1;
            if (isset($b['kitchen_1']['type6']['image' . $_POST['order']['color_type6']]['layer'])) {
                preg_match('~((\w+)([0-9]+)_([0-9]+)_([0-9]+)).png~', $b['kitchen_1']['type6']['image' . $_POST['order']['color_type6']]['layer'], $d);
                /** $d
                 * [2] => handleup
                 * [3] => 4
                 * [4] => 1
                 * [5] => 2
                 */
                // НЕ защищенные от JS куки
                setcookie('type_handle', $d[2], time() + 180000);
                setcookie('subtype_handle', $d[3], time() + 180000);
                setcookie('numimage_handle', $_POST['order']['color_type6'], time() + 180000);
                //
            }

            // запоминаем только цвет
            // колиечство секций ($id) группы шкафов на следующем шаге
            // тут важен ЦВЕТ и ТИП для следующих выборок
//            SiteController::setTagCookies('typecabinet', $result[0]);
//            SiteController::setTagCookies('colorcabinet', $result[2]);


            return $this->redirect('/cabinet/shelmounting-0-0-5', 301);

        }


        return $this->render('handles-0-0-4', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }

    public function ___actionAjax004()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');
        $files['door'] = [];

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';
        if (!isset($_GET['type_door']) OR $_GET['type_door'] == 'null')
            $_GET['type_door'] = '*';
        if (!isset($_GET['color_door']) OR $_GET['color_door'] == 'null')
            $_GET['color_door'] = '*';


        // специально разложено отдельными блоками
        // т.к. затем внутри будут добавляться разные идивидуальеые условия
        // кто с кем может паролваться и на каких условиях
        //
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {

            $files['bookcase'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/border/*.png") as $file) {
            $files['border'][] = $file;
        }
        foreach (glob("./_cabinet/" . $id . "/cornice/*.png") as $file) {
            $files['cornice'][] = $file;
        }

        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 4:
                    //только 3 4
                    if (preg_match('~door[3-4]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 5:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;

            }
        }

        foreach (glob("./_cabinet/" . $id . "/frieze/*.png") as $file) {
            $files['frieze'][] = $file;
        }


        // ручки из двух разных папок
        // ручки из двух разных папок
        // ручки из двух разных папок
        $files['handle'] = [];
        $handle_color = (isset($_GET['color_door']) AND $_GET['color_door'] <> '*') ? $_GET['color_door'] : $_GET['colorcabinet'];
        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2://1-6
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 4://7-12
                    if (preg_match('~handledown[7-9]{1}_.*_' . $handle_color . '~', $file) OR preg_match('~handledown1[0-2]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 5:
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }

//        echo '~_.*_' . $handle_color . '~';
//        exit;

        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }


        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handle
         * handle
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handle['title'] = 'handle';
        foreach ($files['handle'] as $fimg) {
            $handle['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
//        $i = 0;
//        $handleup['title'] = 'handleup';
//        foreach ($files['handleup'] as $fimg) {
//            $handleup['image' . ++$i] = [
//                'color' => '/_furniture/images/bottom.png',
//                'layer' => trim($fimg, '.')
//            ];
//        }


        $list = [
//            'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",

            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handle,
            //'type7' => $handle,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }

    public function actionShelmounting005()
    {
        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

//        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
//        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
//        $this->view->registerJsFile('/js/colorselect_cabinet005.js', ['position' => \yii\web\View::POS_HEAD]);
//        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['shelmounting_type'])) {

            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);
            // НЕ защищенные от JS куки
            setcookie('shelmounting_type', $_POST['shelmounting_type'], time() + 180000);

            // только один тип шкафе без дверей и ручек
            if (in_array($_COOKIE['typecabinet'], [1, 3]))
                return $this->redirect('/cabinet/final-0-0-9', 301);
            else
                return $this->redirect('/cabinet/doors-0-0-3', 301);
        }

        return $this->render('shelmounting-0-0-5', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }


    public function actionBorders006()
    {

        $type = $_COOKIE['typecabinet'];


        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
            return true;
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet006.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {

            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);
            // НЕ защищенные от JS куки


            // хотя  в частном случае если цвет один - то поярдковы номер желемента равен его типу, но мало ли что им в голову сбредет
            //лучше слеоаем сложно и попраивльному
            // преобразуем порядковй номер массива элементов AJAX в его нутренний ID согласно названия фала


            $a = file_get_contents('http://admin:5124315@lavi.new-dating.com/cabinet/ajax-0-0-6?typecabinet=' . $type . '&id=' . $_COOKIE['numsections'] . '&colorcabinet=' . $_COOKIE['colorcabinet'] . '&action=get_colors');
            $b = json_decode($a, true);
            // оенивый юзверь галочку не передвинул и в форме пока пуст -п о дефолту первую аглоку передаем

            if (!$_POST['order']['color_type2']) {
                $_POST['order']['color_type2'] = 1;
            }

            if (!isset($b['kitchen_1']['type2']['image' . $_POST['order']['color_type2']]['layer'])) die('Pls. get select need param on this step');
            preg_match('~([0-9]+_[0-9]+_[0-9]+).png~', $b['kitchen_1']['type2']['image' . $_POST['order']['color_type2']]['layer'], $d);

            $result = explode('_', $d[1]);
//            echo " type".$result[0];
//            echo " color".$result[2];
//            exit;
            // запоминаем только цвет
            // колиечство секций ($id) группы шкафов на следующем шаге
            // тут важен ЦВЕТ и ТИП для следующих выборок
//            SiteController::setTagCookies('typecabinet', $result[0]);
//            SiteController::setTagCookies('colorcabinet', $result[2]);

            if (!$result[0])
                die('No $result[0]');
            if (!$result[2])
                die('No $result[2]');
            // НЕ защищенные от JS куки
            setcookie('typeborder', $result[0], time() + 180000);
            setcookie('imgnuminlist_border', $_POST['order']['color_type2'], time() + 180000);

            //
            //
            //////////////////////////////////////////////////////
            return $this->redirect('/cabinet/shelmounting-0-0-5', 301);
        }

        return $this->render('borders-0-0-6', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }

    public function actionAjax006()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');
        $files['door'] = [];
        $files['border'] = [];
        $files['cornice'] = [];
        $files['frieze'] = [];

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';
        if (!isset($_GET['type_door']) OR $_GET['type_door'] == 'null')
            $_GET['type_door'] = '*';
        if (!isset($_GET['color_door']) OR $_GET['color_door'] == 'null')
            $_GET['color_door'] = '*';


        // один определенный рамера цвета и типа
//        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png") as $file) {
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {

            $files['bookcase'][] = $file;
        }


        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 4:
                    //только 3 4
                    if (preg_match('~door[3-4]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 5:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;

            }
        }


        // ручки из двух разных папок
        // ручки из двух разных папок
        // ручки из двух разных папок
        $files['handle'] = [];
        $handle_color = (isset($_GET['color_door']) AND $_GET['color_door'] <> '*') ? $_GET['color_door'] : $_GET['colorcabinet'];
        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2://1-6
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 4://7-12
                    if (preg_match('~handledown[7-9]{1}_.*_' . $handle_color . '~', $file) OR preg_match('~handledown1[0-2]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 5:
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }
        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }


        foreach (glob("./_cabinet/" . $id . "/border/*_" . $_GET['colorcabinet'] . ".png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~border1_~', $file))
                        $files['border'][] = $file;
                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~border3_~', $file))
                        $files['border'][] = $file;
                    break;
            }
        }

        //
        foreach (glob("./_cabinet/" . $id . "/cornice/*_" . $_GET['colorcabinet'] . ".png") as $file) {
            $files['cornice'][] = $file;
        }

        // тут кто с кем https://docs.google.com/document/d/1HicF2asaCef43XjRRU9E6AqpxTujsoDO1IO0RiSAAkk/edit?ts=5826e864
        foreach (glob("./_cabinet/" . $id . "/frieze/*_" . $_GET['colorcabinet'] . ".png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;
                    break;
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[4-6]{1}_~', $file)
                        OR preg_match('~frieze1[0-1]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze7[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 5:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
            }
        }


        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handle
         * handle
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $decor['title'] = 'decor';
        foreach ($files['decor'] as $fimg) {
            $decor['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handle['title'] = 'handle';
        foreach ($files['handle'] as $fimg) {
            $handle['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
//        $i = 0;
//        $handleup['title'] = 'handleup';
//        foreach ($files['handleup'] as $fimg) {
//            $handleup['image' . ++$i] = [
//                'color' => '/_furniture/images/bottom.png',
//                'layer' => trim($fimg, '.')
//            ];
//        }


        $list = [
//            'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",

            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handle,
            'type7' => $decor,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }

    public function actionCarnice007()
    {
        $type = 1;

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet007.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);


        if (isset($_POST['cornice'])) {
            setcookie('typecornice', $_POST['cornice'], time() + 180000);
            setcookie('imgnuminlist_cornice', $_POST['imgnuminlist_cornice'], time() + 180000);

            return $this->redirect('/cabinet/frieze-0-0-8', 301);
        }
        /*if (isset($_POST['order'])) {

            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);
            // НЕ защищенные от JS куки


            // хотя  в частном случае если цвет один - то поярдковы номер желемента равен его типу, но мало ли что им в голову сбредет
            //лучше слеоаем сложно и попраивльному
            // преобразуем порядковй номер массива элементов AJAX в его нутренний ID согласно названия фала

            $a = file_get_contents('http://admin:5124315@lavi.new-dating.com/cabinet/ajax-0-0-7?typecabinet=' . $type . '&id=' . $_COOKIE['numsections'] . '&colorcabinet=' . $_COOKIE['colorcabinet'] . '&action=get_colors');
            $b = json_decode($a, true);
            // оенивый юзверь галочку не передвинул и в форме пока пуст -п о дефолту первую аглоку передаем
            if (!isset($b['kitchen_1']['type3']['image' . $_POST['order']['color_type3']]['layer'])) die('Pls. get select need param on this step');
            preg_match('~([0-9]+_[0-9]+_[0-9]+).png~', $b['kitchen_1']['type3']['image' . $_POST['order']['color_type3']]['layer'], $d);
            $result = explode('_', $d[1]);
//            echo " type".$result[0];
//            echo " color".$result[2];
//            exit;
            // запоминаем только цвет
            // колиечство секций ($id) группы шкафов на следующем шаге
            // тут важен ЦВЕТ и ТИП для следующих выборок
//            SiteController::setTagCookies('typecabinet', $result[0]);
//            SiteController::setTagCookies('colorcabinet', $result[2]);

            if (!$result[0])
                die('No $result[0]');
            if (!$result[2])
                die('No $result[2]');

            // НЕ защищенные от JS куки
            setcookie('typecornice', $result[0], time() + 180000);
            setcookie('imgnuminlist_cornice', $_POST['order']['color_type3'], time() + 180000);

            //////////////////////////////////////////////////////

            return $this->redirect('/cabinet/frieze-0-0-8', 301);

            // только 2 4 5 типы шкафов выбирают двери
            //if (in_array($_COOKIE['typecabinet'], [2, 4, 5]))
            //    return $this->redirect('/cabinet/doors-0-0-3', 301);
            // else
            //    return $this->redirect('/cabinet/handles-0-0-4', 301);
        }*/

        return $this->render('carnice-0-0-7', [
            'client_id' => $client_id,
            'client_name' => $client_name,
            'type' => $type,
            'typecabinet' => $_COOKIE['typecabinet'],
            'num' => $_COOKIE['numsections'],
            'color' => $_COOKIE['colorcabinet']

        ]);
    }

    public function actionAjax007()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');
        $files['door'] = [];
        $files['border'] = [];
        $files['cornice'] = [];
        $files['frieze'] = [];

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';
        if (!isset($_GET['type_door']) OR $_GET['type_door'] == 'null')
            $_GET['type_door'] = '*';
        if (!isset($_GET['color_door']) OR $_GET['color_door'] == 'null')
            $_GET['color_door'] = '*';


        // один определенный рамера цвета и типа
//        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png") as $file) {
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {

            $files['bookcase'][] = $file;
        }


        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 4:
                    //только 3 4
                    if (preg_match('~door[3-4]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 5:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;

            }
        }


        // ручки из двух разных папок
        // ручки из двух разных папок
        // ручки из двух разных папок
        $files['handle'] = [];
        $handle_color = (isset($_GET['color_door']) AND $_GET['color_door'] <> '*') ? $_GET['color_door'] : $_GET['colorcabinet'];
        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2://1-6
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 4://7-12
                    if (preg_match('~handledown[7-9]{1}_.*_' . $handle_color . '~', $file) OR preg_match('~handledown1[0-2]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 5:
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }
        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }


        foreach (glob("./_cabinet/" . $id . "/border/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~border1_~', $file))
                        $files['border'][] = $file;
                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~border3_~', $file))
                        $files['border'][] = $file;
                    break;
            }
        }

        //
        foreach (glob("./_cabinet/" . $id . "/cornice/*_" . $_GET['colorcabinet'] . ".png") as $file) {
            $files['cornice'][] = $file;
        }

        // тут кто с кем https://docs.google.com/document/d/1HicF2asaCef43XjRRU9E6AqpxTujsoDO1IO0RiSAAkk/edit?ts=5826e864
        foreach (glob("./_cabinet/" . $id . "/frieze/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[7-8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    break;
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[7-8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;

                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[7-8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;

                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[4-6]{1}_~', $file)
                        OR preg_match('~frieze7[A-D]{1}~', $file)
                        OR preg_match('~frieze1[0-1]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;

                    break;
                case 5:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[7-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;

                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[7-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;

                    break;
            }
        }


        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handle
         * handle
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handle['title'] = 'handle';
        foreach ($files['handle'] as $fimg) {
            $handle['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
//        $i = 0;
//        $handleup['title'] = 'handleup';
//        foreach ($files['handleup'] as $fimg) {
//            $handleup['image' . ++$i] = [
//                'color' => '/_furniture/images/bottom.png',
//                'layer' => trim($fimg, '.')
//            ];
//        }


        $list = [
//            'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",

            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handle,
            //'type7' => $handle,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }


    public function actionFrieze008()
    {

        $type = $_COOKIE['typecabinet'];


        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet008.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {

            //тут важно количество секций, остальная херня потом
            // защищенные от JS куки
            //SiteController::setTagCookies('numsections', $_POST['number_sections']);
            // НЕ защищенные от JS куки


            // хотя  в частном случае если цвет один - то поярдковы номер желемента равен его типу, но мало ли что им в голову сбредет
            //лучше слеоаем сложно и попраивльному
            // преобразуем порядковй номер массива элементов AJAX в его нутренний ID согласно названия фала

            $a = file_get_contents('http://admin:5124315@lavi.new-dating.com/cabinet/ajax-0-0-8?typecabinet=' . $type . '&id=' . $_COOKIE['numsections'] . '&colorcabinet=' . $_COOKIE['colorcabinet'] . '&action=get_colors');
            $b = json_decode($a, true);

            // оенивый юзверь галочку не передвинул и в форме пока пуст -п о дефолту первую аглоку передаем
            //ВНИМАНИЕ ТИП С БУКОВОКОЙ
            if (!isset($b['kitchen_1']['type5']['image' . $_POST['order']['color_type5']]['layer'])) die('Pls. get select need param on this step');
            preg_match('~([0-9]+[a-z]{0,1}_[0-9]+_[0-9]+).png~i', $b['kitchen_1']['type5']['image' . $_POST['order']['color_type5']]['layer'], $d);
            $result = explode('_', $d[1]);

            if (!$result[0])
                die('No $result[0]');
            if (!$result[2])
                die('No $result[2]');
            // НЕ защищенные от JS куки
            setcookie('typefrieze', $result[0], time() + 180000);
            setcookie('imgnuminlist_frieze', $_POST['order']['color_type5'], time() + 180000);

           /* //////////////////////////////////////////////////////
            // оенивый юзверь галочку не передвинул и в форме пока пуст -п о дефолту первую аглоку передаем
            //ВНИМАНИЕ ТИП С БУКОВОКОЙ
            if (!isset($b['kitchen_1']['type7']['image' . $_POST['order']['color_type7']]['layer'])) die('Pls. get select need param on this step');
            preg_match('~([0-9]+[a-z]{0,1}_[0-9]+_[0-9]+).png~i', $b['kitchen_1']['type7']['image' . $_POST['order']['color_type7']]['layer'], $d);
            $result = explode('_', $d[1]);

            if (!$result[0])
                die('No $result[0]');
            if (!$result[2])
                die('No $result[2]');
            // НЕ защищенные от JS куки
            setcookie('typedecor', $result[0], time() + 180000);
            setcookie('imgnuminlist_decor', $_POST['order']['color_type7'], time() + 180000);*/

            //////////////////////////////////////////////////////

            if (in_array($_COOKIE['typecabinet'], [2, 3, 4, 6]))
                return $this->redirect('/cabinet/capitel-0-1-8', 301);
            else
                return $this->redirect('/cabinet/shelmounting-0-0-5', 301);

//            // только 2 4 5 типы шкафов выбирают двери
//            if (in_array($_COOKIE['typecabinet'], [2, 4, 5]))
//                return $this->redirect('/cabinet/doors-0-0-3', 301);
//            else
//                return $this->redirect('/cabinet/handles-0-0-4', 301);

        }

        return $this->render('frieze-0-0-8', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }

    public function actionAjax008()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');
        $files['door'] = [];
        $files['border'] = [];
        $files['cornice'] = [];
        $files['frieze'] = [];
        $files['decor'] = [];

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';
        if (!isset($_GET['type_door']) OR $_GET['type_door'] == 'null')
            $_GET['type_door'] = '*';
        if (!isset($_GET['color_door']) OR $_GET['color_door'] == 'null')
            $_GET['color_door'] = '*';


        // один определенный рамера цвета и типа
//        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png") as $file) {
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {

            $files['bookcase'][] = $file;
        }


        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 4:
                    //только 3 4
                    if (preg_match('~door[3-4]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 5:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;

            }
        }


        // ручки из двух разных папок
        // ручки из двух разных папок
        // ручки из двух разных папок
        $files['handle'] = [];
        $handle_color = (isset($_GET['color_door']) AND $_GET['color_door'] <> '*') ? $_GET['color_door'] : $_GET['colorcabinet'];
        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2://1-6
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 4://7-12
                    if (preg_match('~handledown[7-9]{1}_.*_' . $handle_color . '~', $file) OR preg_match('~handledown1[0-2]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 5:
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }
        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }


        foreach (glob("./_cabinet/" . $id . "/border/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~border1_~', $file))
                        $files['border'][] = $file;
                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~border3_~', $file))
                        $files['border'][] = $file;
                    break;
            }
        }

        //
        $n_kapitel = '';
        if(isset($_COOKIE['typecapitel']) && $_COOKIE['typecapitel']!='none')
            $n_kapitel = 'k';
        foreach (glob("./_cabinet/" . $id . "/cornice/cornice{1,4,5}".$n_kapitel."_".$id."_" . $_GET['colorcabinet'] . ".png", GLOB_BRACE) as $file) {
            $files['cornice'][] = $file;
        }

        // тут кто с кем https://docs.google.com/document/d/1HicF2asaCef43XjRRU9E6AqpxTujsoDO1IO0RiSAAkk/edit?ts=5826e864
        foreach (glob("./_cabinet/" . $id . "/frieze/frieze{1,2,3,4,5,6,7,8,9,10,11}".$n_kapitel."_*_" . $_GET['colorcabinet'] . ".png", GLOB_BRACE) as $file)
        {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;
                    break;
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[4-6]{1}_~', $file)
                        OR preg_match('~frieze1[0-1]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze7[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 5:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
            }
        }

        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handle
         * handle
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $decor['title'] = 'decor';
        foreach ($files['decor'] as $fimg) {
            $decor['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handle['title'] = 'handle';
        foreach ($files['handle'] as $fimg) {
            $handle['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
//        $i = 0;
//        $handleup['title'] = 'handleup';
//        foreach ($files['handleup'] as $fimg) {
//            $handleup['image' . ++$i] = [
//                'color' => '/_furniture/images/bottom.png',
//                'layer' => trim($fimg, '.')
//            ];
//        }


        $list = [
//            'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",

            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handle,
            'type7' => $decor,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }


    public function actionCapitel018()
    {

        $type = $_COOKIE['typecabinet'];


        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet018.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {

            setcookie('typecapitel', $_POST['capitel'], time() + 180000);

            if (in_array($_COOKIE['typecabinet'], [2, 3, 4, 6]))
                return $this->redirect('/cabinet/decor-0-1-8', 301);
            else
                return $this->redirect('/cabinet/shelmounting-0-0-5', 301);


        }

        return $this->render('capitel-0-1-8', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }

    public function actionAjax018()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');
        $files['door'] = [];
        $files['border'] = [];
        $files['cornice'] = [];
        $files['frieze'] = [];
        $files['decor'] = [];

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';
        if (!isset($_GET['type_door']) OR $_GET['type_door'] == 'null')
            $_GET['type_door'] = '*';
        if (!isset($_GET['color_door']) OR $_GET['color_door'] == 'null')
            $_GET['color_door'] = '*';


        // один определенный рамера цвета и типа
//        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png") as $file) {
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {

            $files['bookcase'][] = $file;
        }


        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 4:
                    //только 3 4
                    if (preg_match('~door[3-4]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 5:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;

            }
        }


        // ручки из двух разных папок
        // ручки из двух разных папок
        // ручки из двух разных папок
        $files['handle'] = [];
        $handle_color = (isset($_GET['color_door']) AND $_GET['color_door'] <> '*') ? $_GET['color_door'] : $_GET['colorcabinet'];
        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2://1-6
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 4://7-12
                    if (preg_match('~handledown[7-9]{1}_.*_' . $handle_color . '~', $file) OR preg_match('~handledown1[0-2]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 5:
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }
        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }


        foreach (glob("./_cabinet/" . $id . "/border/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~border1_~', $file))
                        $files['border'][] = $file;
                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~border3_~', $file))
                        $files['border'][] = $file;
                    break;
            }
        }

        //
        $n_kapitel = '';
        if(isset($_COOKIE['typecapitel']) && $_COOKIE['typecapitel']!='none')
            $n_kapitel = 'k';

        foreach (glob("./_cabinet/" . $id . "/cornice/cornice{1,4,5}".$n_kapitel."_".$id."_" . $_GET['colorcabinet'] . ".png", GLOB_BRACE) as $file) {
            $files['cornice'][] = $file;
        }

        // тут кто с кем https://docs.google.com/document/d/1HicF2asaCef43XjRRU9E6AqpxTujsoDO1IO0RiSAAkk/edit?ts=5826e864
        foreach (glob("./_cabinet/" . $id . "/frieze/frieze{1,2,3,4,5,6,7,8,9,10,11}".$n_kapitel."_*_" . $_GET['colorcabinet'] . ".png", GLOB_BRACE) as $file)
        {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;
                    break;
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[4-6]{1}_~', $file)
                        OR preg_match('~frieze1[0-1]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze7[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 5:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
            }
        }

        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handle
         * handle
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $decor['title'] = 'decor';
        foreach ($files['decor'] as $fimg) {
            $decor['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handle['title'] = 'handle';
        foreach ($files['handle'] as $fimg) {
            $handle['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
//        $i = 0;
//        $handleup['title'] = 'handleup';
//        foreach ($files['handleup'] as $fimg) {
//            $handleup['image' . ++$i] = [
//                'color' => '/_furniture/images/bottom.png',
//                'layer' => trim($fimg, '.')
//            ];
//        }


        $list = [
//            'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",

            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handle,
            'type7' => $decor,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }

    public function actionDecor018()
    {

        $type = $_COOKIE['typecabinet'];


        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet118.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {
            $a = file_get_contents('http://admin:5124315@lavi.new-dating.com/cabinet/ajax-1-1-8?typecabinet=' . $type . '&id=' . $_COOKIE['numsections'] . '&colorcabinet=' . $_COOKIE['colorcabinet'] . '&action=get_colors');
            $b = json_decode($a, true);
             //////////////////////////////////////////////////////
             // оенивый юзверь галочку не передвинул и в форме пока пуст -п о дефолту первую аглоку передаем
             //ВНИМАНИЕ ТИП С БУКОВОКОЙ
             if (!isset($b['kitchen_1']['type7']['image' . $_POST['order']['color_type7']]['layer'])) die('Pls. get select need param on this step');
             preg_match('~([0-9]+[a-z]{0,1}_[0-9]+_[0-9]+).png~i', $b['kitchen_1']['type7']['image' . $_POST['order']['color_type7']]['layer'], $d);
             $result = explode('_', $d[1]);

             if (!$result[0])
                 die('No $result[0]');
             if (!$result[2])
                 die('No $result[2]');
             // НЕ защищенные от JS куки
             setcookie('typedecor', $result[0], time() + 180000);
             setcookie('imgnuminlist_decor', $_POST['order']['color_type7'], time() + 180000);
             setcookie('decor_position', $_POST['cornice'], time() + 180000);

            //////////////////////////////////////////////////////

            return $this->redirect('/cabinet/shelmounting-0-0-5', 301);
        }

        return $this->render('decor-0-1-8', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }

    public function actionAjax118()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');
        $files['door'] = [];
        $files['border'] = [];
        $files['cornice'] = [];
        $files['frieze'] = [];
        $files['decor'] = [];

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');


        if (!isset($_GET['typecabinet']) OR $_GET['typecabinet'] == 'null')
            $_GET['typecabinet'] = '*';
        if (!isset($_GET['colorcabinet']) OR $_GET['colorcabinet'] == 'null')
            $_GET['colorcabinet'] = '*';
        if (!isset($_GET['type_door']) OR $_GET['type_door'] == 'null')
            $_GET['type_door'] = '*';
        if (!isset($_GET['color_door']) OR $_GET['color_door'] == 'null')
            $_GET['color_door'] = '*';


        // один определенный рамера цвета и типа
//        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_{$_GET['colorcabinet']}.png") as $file) {
        foreach (glob("./_cabinet/" . $id . "/bookcase/bookcase" . $_GET['typecabinet'] . "_*.png") as $file) {

            $files['bookcase'][] = $file;
        }


        foreach (glob("./_cabinet/" . $id . "/door/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 4:
                    //только 3 4
                    if (preg_match('~door[3-4]{1}_~', $file))
                        $files['door'][] = $file;
                    break;
                case 5:
                    //только 1 2
                    if (preg_match('~door[1-2]{1}_~', $file))
                        $files['door'][] = $file;
                    break;

            }
        }


        // ручки из двух разных папок
        // ручки из двух разных папок
        // ручки из двух разных папок
        $files['handle'] = [];
        $handle_color = (isset($_GET['color_door']) AND $_GET['color_door'] <> '*') ? $_GET['color_door'] : $_GET['colorcabinet'];
        foreach (glob("./_cabinet/" . $id . "/handledown/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2://1-6
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 4://7-12
                    if (preg_match('~handledown[7-9]{1}_.*_' . $handle_color . '~', $file) OR preg_match('~handledown1[0-2]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 5:
                    if (preg_match('~handledown[1-6]{1}_.*_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }
        foreach (glob("./_cabinet/" . $id . "/handleup/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~_[0-9]+_' . $handle_color . '~', $file))
                        $files['handle'][] = $file;
                    break;
            }
        }


        foreach (glob("./_cabinet/" . $id . "/border/*.png") as $file) {
            switch ($_GET['typecabinet']) {
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~border1_~', $file))
                        $files['border'][] = $file;
                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~border2_~', $file))
                        $files['border'][] = $file;
                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~border3_~', $file))
                        $files['border'][] = $file;
                    break;
            }
        }

        //
        $n_kapitel = '';
        if(isset($_COOKIE['typecapitel']) && $_COOKIE['typecapitel']!='none')
            $n_kapitel = 'k';

        foreach (glob("./_cabinet/" . $id . "/cornice/cornice{1,4,5}".$n_kapitel."_".$id."_" . $_GET['colorcabinet'] . ".png", GLOB_BRACE) as $file) {
            $files['cornice'][] = $file;
        }

        // тут кто с кем https://docs.google.com/document/d/1HicF2asaCef43XjRRU9E6AqpxTujsoDO1IO0RiSAAkk/edit?ts=5826e864
        foreach (glob("./_cabinet/" . $id . "/frieze/*_" . $_GET['colorcabinet'] . ".png", GLOB_BRACE) as $file)
        {
            switch ($_GET['typecabinet']) {
                case 1:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;
                    break;
                case 2:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 3:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 4:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[4-6]{1}_~', $file)
                        OR preg_match('~frieze1[0-1]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze7[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 5:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
                case 6:
                    //любая верхняя нужного цвета
                    if (preg_match('~frieze[1-3]{1}_~', $file)
                        OR preg_match('~frieze[8-9]{1}[A-D]{1}~', $file)
                    )
                        $files['frieze'][] = $file;
                    else if (preg_match('~frieze[7]{1}[A-D]{1}~', $file)
                    )
                        $files['decor'][] = $file;

                    break;
            }
        }

        //$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';
        //print_r[json_decode[$a, true]];

        /**
         * bookcase
         * border
         * cornice
         * door
         * frieze
         * handle
         * handle
         */

        $i = 0;
        $bookcase['title'] = 'bookcase';
        foreach ($files['bookcase'] as $fimg) {
            $bookcase['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $border['title'] = 'border';
        foreach ($files['border'] as $fimg) {
            $border['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $cornice['title'] = 'cornice';
        foreach ($files['cornice'] as $fimg) {
            $cornice['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $door['title'] = 'door';
        foreach ($files['door'] as $fimg) {
            $door['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $frieze['title'] = 'frieze';
        foreach ($files['frieze'] as $fimg) {
            $frieze['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $decor['title'] = 'decor';
        foreach ($files['decor'] as $fimg) {
            $lt = 'A';
            if($i===1)
                $lt = 'B';
            elseif($i===2)
                $lt = 'C';
            elseif($i===3)
                $lt = 'D';

            $decor['image' . ++$i] = [
                'color' => '/_cabinet/decor/decor'.$lt.'.png',
                'layer' => trim($fimg, '.')
            ];
        }
        $i = 0;
        $handle['title'] = 'handle';
        foreach ($files['handle'] as $fimg) {
            $handle['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];
        }
//        $i = 0;
//        $handleup['title'] = 'handleup';
//        foreach ($files['handleup'] as $fimg) {
//            $handleup['image' . ++$i] = [
//                'color' => '/_furniture/images/bottom.png',
//                'layer' => trim($fimg, '.')
//            ];
//        }


        $list = [
//            'background' => trim($files['bookcase'][0], '.'),
            //жестко цвет ебеничка
            'background' => "/_cabinet/" . $id . "/bookcase/bookcase{$_GET['typecabinet']}_{$id}_1.png",

            'type1' => $bookcase,
            'type2' => $border,
            'type3' => $cornice,
            'type4' => $door,
            'type5' => $frieze,
            'type6' => $handle,
            'type7' => $decor,
        ];

        $pattern_arr =
            [
                'kitchen_1' =>
                    $list
            ];

        return json_encode($pattern_arr);
    }

    public function actionFinal009()
    {


        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
        }

        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');


        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect_cabinet009.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);

        if (isset($_POST['order'])) {

            return $this->actionPdf();

        }

        return $this->render('final-0-0-9', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }


    public function actionPdf()
    {

//        $vars = $this->getValues();
//        var_dump($vars);
//        die();

        // Берем параметры из сессии
        $cookies = Yii::$app->request->cookies;

        $clientId  =  $cookies->getValue('dir_id_mfiles');
        $clientName = $cookies->getValue('dir_name_mfiles');

        $signFilePath='';

        // здесь данные из базы по нашей ФОРМЕ
//        $form_fields_from_db = $my_json_in[1];
        $form_fields_from_db['name'] = 'CABINET';
        //$form_fields_from_db['internal_emails'] = 'ruslan.novikov@gmail.com;rlopatkin@gmail.com;l_rom@mail.ru;sergei.epshtein@gmail.com';
        $form_fields_from_db['internal_emails'] = 'makord1@yandex.ru';
        $form_fields_from_db['internal_message'] = 'Message';
        $form_fields_from_db['mfiles_meta_class_id'] = 10;
        $form_fields_from_db['mfiles_meta_dropdwn_001_id'] = 10;
        $form_fields_from_db['mfiles_meta_dropdwn_002_id'] = 10;

        // Преобразовываем тип
        $originType = $_COOKIE['typecabinet'];
        if (in_array($originType, [1,2])) {
            $type = 1;
        } else {
            $type = 2;
        }

        $chert = '_cabinet/'.$_COOKIE['numsections'].'/bookcase/bookcase'.$originType.'_'.$_COOKIE['numsections'].'_'.$_COOKIE['colorcabinet'].'.png';
        $content = '<table width="800px;" border="0"><tr><td style="text-align:center;"><img src="'.$chert.'" style="width:900px;"></td></tr></table><br/>';

        // Сборка из выбранных элементов

        // Цвет и тип
        $color = $_COOKIE['colorcabinet'];
        $img1Name = $chert;
        $img1 = @imagecreatefrompng($img1Name);

        try
        {
            $img4 = @imagecreatefrompng('_cabinet/'.$_COOKIE['numsections'].'/cornice/cornice'.$_COOKIE['typecornice'].'_'.$_COOKIE['numsections'].'_'.$_COOKIE['colorcabinet'].'.png');
            imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);
        } catch (\Exception $e){};

        try
        {
            $img4 = @imagecreatefrompng('_cabinet/'.$_COOKIE['numsections'].'/frieze/frieze'.$_COOKIE['typefrieze'].'_'.$_COOKIE['numsections'].'_'.$_COOKIE['colorcabinet'].'.png');
            imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);
        } catch (\Exception $e){};

        try
        {
            if(isset($_COOKIE['typecapitel']) && $_COOKIE['typecapitel']!='none')
            {
                $img4 = @imagecreatefrompng('_cabinet/'.$_COOKIE['numsections'].'/frieze/frieze'.$_COOKIE['typefrieze'].'k_'.$_COOKIE['numsections'].'_'.$_COOKIE['colorcabinet'].'.png');
                imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);
            }

        } catch (\Exception $e){};
        try
        {
            $img4 = @imagecreatefrompng('_cabinet/'.$_COOKIE['numsections'].'/frieze/frieze'.$_COOKIE['typefrieze'].'k_'.$_COOKIE['numsections'].'_'.$_COOKIE['colorcabinet'].'.png');
            imagecopy($img1, $img4, 0, 0, 0, 0, 1500, 1500);

        } catch (\Exception $e){};


        // Сохраняем собранную картинку
        $fileName = $clientId . "_" . time() . "_" . rand(383, 1000);
        $imgFilePath = '../../_img.cache/' . $fileName . '.png';
//        header('Content-Type: image/gif');
        imagegif($img1, $imgFilePath);
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
                '0' => '_cabinet/cube_placement/'.$_COOKIE['placement'].'c.png',
                '1' => 'Placement #' . $_COOKIE['placement'],
            );
        } catch (\Exception $e){};
        try
        {
            $rows[] = array(
                '0' => '_altar/1/alt_color/wood'.$_COOKIE['colorcabinet'].'.jpg',
                '1' => 'Color #' . $_COOKIE['colorcabinet'],
            );
        } catch (\Exception $e){};

        try
        {
            $rows[] = array(
                '0' => '',
                '1' => 'Number of sections #' . $_COOKIE['numsections'],
            );
        } catch (\Exception $e){};

        try
        {
            $rows[] = array(
                '0' => '_cabinet/preview_cornice/cornice'.$_COOKIE['typecornice'].'.png',
                '1' => 'Cornice #' . $_COOKIE['typecornice'],
            );
        } catch (\Exception $e){};

        try
        {
            $rows[] = array(
                '0' => '',
                '1' => 'Frieze #' . $_COOKIE['typefrieze'],
            );
        } catch (\Exception $e){};

        try
        {
            $img_cpt = '';
            if(isset($_COOKIE['typecapitel']) && $_COOKIE['typecapitel']!='none')
                $img_cpt = '_cabinet/capitel/empty.png';

            $rows[] = array(
                '0' => $img_cpt,
                '1' => 'Capitel #' . $_COOKIE['typecapitel'],
            );
        } catch (\Exception $e){};

        try
        {
            $rows[] = array(
                '0' => '',
                '1' => 'Frieze #' . $_COOKIE['typefrieze'],
            );
        } catch (\Exception $e){};

        try
        {
            $lt = 'A';
            if($_COOKIE['type_door']===1)
                $lt = 'B';
            elseif($_COOKIE['type_door']===2)
                $lt = 'C';
            elseif($_COOKIE['type_door']===3)
                $lt = 'D';

            $color_dcr = '_cabinet/decor/decor'.$lt.'.png';
            $rows[] = array(
                '0' => $color_dcr,
                '1' => 'Decor #' . $_COOKIE['type_door'],
            );
        } catch (\Exception $e){};


        try
        {
            $rows[] = array(
                '0' => '_cabinet/decor/frieze'.$lt.'_'.$_COOKIE['decor_position'].'.png',
                '1' => 'Decor position #' . $_COOKIE['decor_position'],
            );
        } catch (\Exception $e){};

        try
        {
            $rows[] = array(
                '0' => 'images/shelf00'.$_COOKIE['alcovemounting_type'].'.png',
                '1' => 'Mounting #' . $_COOKIE['alcovemounting_type'],
            );
        } catch (\Exception $e){};

        try
        {
            $rows[] = array(
                '0' => '_cabinet/handle/handle'.$_COOKIE['type_handle'].'.png',
                '1' => 'Handle #' . $_COOKIE['type_handle'],
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
