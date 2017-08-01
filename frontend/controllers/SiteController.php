<?php
namespace frontend\controllers;

use common\models\GalleriesItemsPhoto;
use common\models\GalleriesPhotomarkup;
use frontend\models\Mfiles;
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
use yii\web\Cookie;


/**
 * Site controller
 */
class SiteController extends Controller
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

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionClient()
    {

        $cookies = Yii::$app->request->cookies;
        $client_name = $cookies->getValue('dir_name_mfiles');
        if (!$client_name) {
            $client_name = "Client not selected";
        }


        $r = false;
        $request = '';

        if (isset($_POST['search_button'])) {
            $mfiles = new Mfiles();
            //$mfiles->root_dir_path = 'V6914';
            //        $client_list = $mfiles->reading_dir_by_path_json_array();
            //        foreach ($client_list as $l) {
            //            $r[$l['id'] . "#" . $l['name']] = $l['name'];
            //        }


            // если наипнулся сервер мфайлс - это времнная заглушка
            // если наипнулся сервер мфайлс - это времнная заглушка
            // если наипнулся сервер мфайлс - это времнная заглушка
            // если наипнулся сервер мфайлс - это времнная заглушка

            /*
            $search_list = [
                'error' => 0,
                'result' => [
                    ['id' => 1, 'name' => 'TEST01'],
                    ['id' => 2, 'name' => 'TEST02'],
                ],
            ];
            */

            $search_list = $mfiles->search_in_dir_by_title_name($_POST['search']);


            $request = $_POST['search'];
            if (!$search_list['error']) {
                foreach ($search_list['result'] as $l) {
                    $r[$l['id'] . "#" . $l['name']] = $l['name'];
                }
                //print_r($search_list);
            }

        } else if (isset($_POST['dropbox_button'])) {
            $dir_id_mfiles = explode('#', $_POST['client_id_mfiles']);
            // запоминаем куки
            SiteController::setTagCookies('dir_id_mfiles', $dir_id_mfiles[0]);
            SiteController::setTagCookies('dir_name_mfiles', $dir_id_mfiles[1]);

            // редирект
            return $this->redirect("/site/photo");
        }
        //
        return $this->render('client', [
            'client_list' => $r,
            'client_name' => $client_name,
            'request' => $request
        ]);


    }

    static function setTagCookies($name, $value)
    {
        $name = trim($name);
        $cookies = Yii::$app->response->cookies;
//        $cookies = Yii::$app->getResponse()->getCookies();
        //$cookies->readOnly = 0;
        // add a new cookie to the response to be sent
        $cookies->add(new Cookie([
            'name' => $name,
            'value' => $value,
        ]));
    }


    public function delTagCookies($name)
    {
        $name = trim($name);
//        $this->setTagCookies($name, 2);
//        $cookies = Yii::$app->getResponse()->getCookies();
        $cookies = Yii::$app->response->cookies;
        $cookies->remove($name);
        unset($cookies[$name]);
    }


    public function actionFurniture($id)
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


        $this->view->registerJsFile('/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/jquery-ui-1.8.21.custom.min.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerJsFile('/js/colorselect.js', ['position' => \yii\web\View::POS_HEAD]);
        $this->view->registerCssFile('/css/colorselect.css', ['position' => \yii\web\View::POS_HEAD]);


        return $this->render('furniture', [
            'id' => $id,
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }

    public function actionFurnitureAjax()
    {
// источник http://www.forema.ru/color_3.php
//        header('Content-Type: application/json');

        //set content type xml in response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');

        $id = 1;
        if (isset($_GET['id'])) $id = $_GET['id'];
// чтобы избеджать ждублей - соберем сначал общий массив
        foreach (glob("./_furniture/" . $id . "/img/*.png") as $file) {
            if (preg_match('/_cloth/', $file)) $files['cloth'][] = $file;
            else if (preg_match('/_pattern/', $file)) $files['pattern'][] = $file;
            else if (preg_match('/_wood/', $file)) $files['wood'][] = $file;
            else if (preg_match('/_polosa/', $file)) $files['string'][] = $file;
        }

//$a = '{"kitchen_1":{"background":"'uploads\/kitchen\/bg_1.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image45":{"color":"'uploads\/color_calc\/color_45_[48x48c].png'","layer":"'uploads\/color_calc\/model_45.png'"},"image44":{"color":"'uploads\/color_calc\/color_44_[48x48c].png'","layer":"'uploads\/color_calc\/model_44.png'"},"image43":{"color":"'uploads\/color_calc\/color_43_[48x48c].png'","layer":"'uploads\/color_calc\/model_43.png'"},"image42":{"color":"'uploads\/color_calc\/color_42_[48x48c].png'","layer":"'uploads\/color_calc\/model_42.png'"},"image41":{"color":"'uploads\/color_calc\/color_41_[48x48c].png'","layer":"'uploads\/color_calc\/model_41.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image40":{"color":"'uploads\/color_calc\/color_40_[48x48c].png'","layer":"'uploads\/color_calc\/model_40.png'"},"image39":{"color":"'uploads\/color_calc\/color_39_[48x48c].png'","layer":"'uploads\/color_calc\/model_39.png'"},"image38":{"color":"'uploads\/color_calc\/color_38_[48x48c].png'","layer":"'uploads\/color_calc\/model_38.png'"},"image37":{"color":"'uploads\/color_calc\/color_37_[48x48c].png'","layer":"'uploads\/color_calc\/model_37.png'"},"image36":{"color":"'uploads\/color_calc\/color_36_[48x48c].png'","layer":"'uploads\/color_calc\/model_36.png'"},"image46":{"color":"'uploads\/color_calc\/color_46_[48x48c].png'","layer":"'uploads\/color_calc\/model_46.png'"},"image47":{"color":"'uploads\/color_calc\/color_47_[48x48c].png'","layer":"'uploads\/color_calc\/model_47.png'"},"image48":{"color":"'uploads\/color_calc\/color_48_[48x48c].png'","layer":"'uploads\/color_calc\/model_48.png'"},"image49":{"color":"'uploads\/color_calc\/color_49_[48x48c].png'","layer":"'uploads\/color_calc\/model_49.png'"},"image50":{"color":"'uploads\/color_calc\/color_50_[48x48c].png'","layer":"'uploads\/color_calc\/model_50.png'"},"image51":{"color":"'uploads\/color_calc\/color_51_[48x48c].png'","layer":"'uploads\/color_calc\/model_51.png'"},"image52":{"color":"'uploads\/color_calc\/color_52_[48x48c].png'","layer":"'uploads\/color_calc\/model_52.png'"},"image53":{"color":"'uploads\/color_calc\/color_53_[48x48c].png'","layer":"'uploads\/color_calc\/model_53.png'"},"image54":{"color":"'uploads\/color_calc\/color_54_[48x48c].png'","layer":"'uploads\/color_calc\/model_54.png'"},"image55":{"color":"'uploads\/color_calc\/color_55_[48x48c].png'","layer":"'uploads\/color_calc\/model_55.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image35":{"color":"'uploads\/color_calc\/color_35_[48x48c].png'","layer":"'uploads\/color_calc\/model_35.png'"},"image34":{"color":"'uploads\/color_calc\/color_34_[48x48c].png'","layer":"'uploads\/color_calc\/model_34.png'"},"image33":{"color":"'uploads\/color_calc\/color_33_[48x48c].png'","layer":"'uploads\/color_calc\/model_33.png'"},"image32":{"color":"'uploads\/color_calc\/color_32_[48x48c].png'","layer":"'uploads\/color_calc\/model_32.png'"},"image31":{"color":"'uploads\/color_calc\/color_31_[48x48c].png'","layer":"'uploads\/color_calc\/model_31.png'"}}},"kitchen_2":{"background":"'uploads\/kitchen\/bg_2.jpg'","type3":{"title":"\u041d\u0438\u0436\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image20":{"color":"'uploads\/color_calc\/color_20_[48x48c].png'","layer":"'uploads\/color_calc\/model_20.png'"},"image19":{"color":"'uploads\/color_calc\/color_19_[48x48c].png'","layer":"'uploads\/color_calc\/model_19.png'"},"image18":{"color":"'uploads\/color_calc\/color_18_[48x48c].png'","layer":"'uploads\/color_calc\/model_18.png'"},"image17":{"color":"'uploads\/color_calc\/color_17_[48x48c].png'","layer":"'uploads\/color_calc\/model_17.png'"},"image16":{"color":"'uploads\/color_calc\/color_16_[48x48c].png'","layer":"'uploads\/color_calc\/model_16.png'"},"image15":{"color":"'uploads\/color_calc\/color_15_[48x48c].png'","layer":"'uploads\/color_calc\/model_15.png'"},"image14":{"color":"'uploads\/color_calc\/color_14_[48x48c].png'","layer":"'uploads\/color_calc\/model_14.png'"},"image13":{"color":"'uploads\/color_calc\/color_13_[48x48c].png'","layer":"'uploads\/color_calc\/model_13.png'"},"image12":{"color":"'uploads\/color_calc\/color_12_[48x48c].png'","layer":"'uploads\/color_calc\/model_12.png'"},"image11":{"color":"'uploads\/color_calc\/color_11_[48x48c].png'","layer":"'uploads\/color_calc\/model_11.png'"}},"type2":{"title":"\u0421\u0442\u043e\u043b\u0435\u0448\u043d\u0438\u0446\u0430 \u0438 \u0444\u0430\u0440\u0442\u0443\u043a","image30":{"color":"'uploads\/color_calc\/color_30_[48x48c].png'","layer":"'uploads\/color_calc\/model_30.png'"},"image29":{"color":"'uploads\/color_calc\/color_29_[48x48c].png'","layer":"'uploads\/color_calc\/model_29.png'"},"image28":{"color":"'uploads\/color_calc\/color_28_[48x48c].png'","layer":"'uploads\/color_calc\/model_28.png'"},"image27":{"color":"'uploads\/color_calc\/color_27_[48x48c].png'","layer":"'uploads\/color_calc\/model_27.png'"},"image26":{"color":"'uploads\/color_calc\/color_26_[48x48c].png'","layer":"'uploads\/color_calc\/model_26.png'"},"image25":{"color":"'uploads\/color_calc\/color_25_[48x48c].png'","layer":"'uploads\/color_calc\/model_25.png'"},"image24":{"color":"'uploads\/color_calc\/color_24_[48x48c].png'","layer":"'uploads\/color_calc\/model_24.png'"},"image23":{"color":"'uploads\/color_calc\/color_23_[48x48c].png'","layer":"'uploads\/color_calc\/model_23.png'"},"image22":{"color":"'uploads\/color_calc\/color_22_[48x48c].png'","layer":"'uploads\/color_calc\/model_22.png'"},"image21":{"color":"'uploads\/color_calc\/color_21_[48x48c].png'","layer":"'uploads\/color_calc\/model_21.png'"},"image56":{"color":"'uploads\/color_calc\/color_56_[48x48c].png'","layer":"'uploads\/color_calc\/model_56.png'"},"image57":{"color":"'uploads\/color_calc\/color_57_[48x48c].png'","layer":"'uploads\/color_calc\/model_57.png'"},"image58":{"color":"'uploads\/color_calc\/color_58_[48x48c].png'","layer":"'uploads\/color_calc\/model_58.png'"},"image59":{"color":"'uploads\/color_calc\/color_59_[48x48c].png'","layer":"'uploads\/color_calc\/model_59.png'"},"image60":{"color":"'uploads\/color_calc\/color_60_[48x48c].png'","layer":"'uploads\/color_calc\/model_60.png'"}},"type1":{"title":"\u0412\u0435\u0440\u043d\u0445\u043d\u044f\u044f \u0447\u0430\u0441\u0442\u044c","image10":{"color":"'uploads\/color_calc\/color_10_[48x48c].png'","layer":"'uploads\/color_calc\/model_10.png'"},"image9":{"color":"'uploads\/color_calc\/color_9_[48x48c].png'","layer":"'uploads\/color_calc\/model_9.png'"},"image8":{"color":"'uploads\/color_calc\/color_8_[48x48c].png'","layer":"'uploads\/color_calc\/model_8.png'"},"image7":{"color":"'uploads\/color_calc\/color_7_[48x48c].png'","layer":"'uploads\/color_calc\/model_7.png'"},"image6":{"color":"'uploads\/color_calc\/color_6_[48x48c].png'","layer":"'uploads\/color_calc\/model_6.png'"},"image5":{"color":"'uploads\/color_calc\/color_5_[48x48c].png'","layer":"'uploads\/color_calc\/model_5.png'"},"image4":{"color":"'uploads\/color_calc\/color_4_[48x48c].png'","layer":"'uploads\/color_calc\/model_4.png'"},"image3":{"color":"'uploads\/color_calc\/color_3_[48x48c].png'","layer":"'uploads\/color_calc\/model_3.png'"},"image2":{"color":"'uploads\/color_calc\/color_2_[48x48c].png'","layer":"'uploads\/color_calc\/model_2.png'"},"image1":{"color":"'uploads\/color_calc\/color_1_[48x48c].png'","layer":"'uploads\/color_calc\/model_1.png'"}}}}';

//print_r[json_decode[$a, true]];

        $i = 0;
        $a['title'] = 'Wood';
        foreach ($files['wood'] as $fimg) {

            $a['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];

        }

        $i = 0;
        $b['title'] = 'Cloth';
        foreach ($files['cloth'] as $fimg) {

            $b['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];

        }

        $i = 0;
        $c['title'] = 'Pattern';
        foreach ($files['pattern'] as $fimg) {

            $c['image' . ++$i] = [
                'color' => '/_furniture/images/bottom.png',
                'layer' => trim($fimg, '.')
            ];

        }

        $d = [];
        if (isset($files['string'])) {
            $i = 0;
            $d['title'] = 'String';
            foreach ($files['string'] as $fimg) {

                $d['image' . ++$i] = [
                    'color' => '/_furniture/images/bottom.png',
                    'layer' => trim($fimg, '.')
                ];

            }
        }


        $list = [
            'background' => trim($files['wood'][0], '.'),
            'type3' => $a,
            'type2' => $b,
            'type1' => $c,
            'type4' => $d,
        ];

        $pattern_arr =
            [
                'kitchen_' . $id =>
                    $list
            ];

        return json_encode($pattern_arr);
    }


    public function actionPhoto()
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


        //в контроллере или виджете
        $this->view->registerJsFile('/js/webcam.js', ['position' => \yii\web\View::POS_HEAD]);

        return $this->render('photo', [
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }


    public function actionMarkingPhotoList()
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


        foreach (glob("./_making_photos/*.PNG") as $img) {
            preg_match('/(\d+)\.PNG/', $img, $d);
            $list_id[] = $d[1];
        }


        return $this->render('marking-photo-list', [
            'client_id' => $client_id,
            'client_name' => $client_name,
            'list' => $list_id
        ]);
    }


    public function actionMarkingPhotoList2($id)
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


        $items = GalleriesItemsPhoto::find()
            ->Where('`gallery_id` = ' . $id)
            ->all();
        $list_items = [];
        foreach ($items as $item) {
            $item->id = $item->id_item;
            $list_items[] = $item;
        }

        $gallery_model = GalleriesPhotomarkup::find()->where(['id_gallery' => $id])->one();


//        foreach (glob("./_making_photos/*.PNG") as $img) {
//            preg_match('/(\d+)\.PNG/', $img, $d);
//            $list_id[] = $d[1];
//        }

        return $this->render('marking-photo-list-2', [
            'gallery_model' => $gallery_model,
            'client_id' => $client_id,
            'client_name' => $client_name,
            'list' => $list_items
        ]);
    }

    public function actionMarkingPhoto($id)
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


        //в контроллере или виджете
        $this->view->registerJsFile('/js/webcam.js', ['position' => \yii\web\View::POS_HEAD]);

        $sql = 'SELECT * FROM `my_galleries_items_photo` as ph LEFT JOIN `attach_file` af ON `af`.`itemId` = `ph`.`id_item` WHERE `af`.`id` = ' . $id;
        $item = GalleriesItemsPhoto::findBySql($sql)->one();
        $gallery_model = GalleriesPhotomarkup::find()->where(['id_gallery' => $item->gallery_id])->one();
//print_r($item);
//        exit;

        return $this->render('marking-photo', [
            'item_name' => $item->name_item . ' - ' . $gallery_model->name_gallery,
            'photo_id' => $id,
            'client_id' => $client_id,
            'client_name' => $client_name
        ]);
    }


    public function actionMarkingPhotoGeneratefile()
    {
        $photo_id = $_GET['photo_id'];
        $client_id = $_GET['id'];
        $client_name = $_GET['name'];
        $comments = $_GET['comments'];
        $cords = trim($_GET['cords'], '[]');

        $this->layout = 'zerro';

        return $this->render('marking-photo-generatefile', [
            'photo_id' => $photo_id,
            'client_id' => $client_id,
            'client_name' => $client_name,
            'cords' => $cords,
            'comments' => $comments,

        ]);
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
