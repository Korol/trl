<?php
namespace frontend\controllers;

use Yii;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Cookie;

/**
 * Altar controller
 */
class AltarController extends Controller
{

    public function beforeAction($action)
    {
        $cookies = Yii::$app->request->cookies;

        // Проверяем наличие установленного клиента
        $clientId = $cookies->getValue('dir_id_mfiles');
        if ( $clientId == NULL ) {
            return $this->redirect("/site/client")->send();
        }

        // Запихиваем клиента в куки нашего формата
        $this->setTagCookies('client_id', $cookies->getValue('dir_id_mfiles'));
        $this->setTagCookies('client_name', $cookies->getValue('dir_name_mfiles'));

        // Перетянем все имеющиеся переменные из кук запроса в куки ответа
        $this->fromRequestToResponseCookies();

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

    private function setTagCookies($name, $value)
    {
        $name = trim($name);
        $cookies = Yii::$app->response->cookies;
        if ( isset($cookies[$name]) ) {
            unset($cookies[$name]);
        }
        $cookies->add(new Cookie([
            'name' => $name,
            'value' => $value,
            'expire' => time() + 18000
        ]));
    }

    private function fromRequestToResponseCookies() {
        foreach ( $this->getVars() as $var ) {
            if ( isset( Yii::$app->request->cookies[$var] ) ) {
                $this->setTagCookies($var, Yii::$app->request->cookies[$var]);
            }
        }
    }

    // Перечень всех пеерменных, котоорые соберутся в процессе прохождения всей процедуры
    private function getVars()
    {
        $vars = [
            'client_id',
            'client_name',
            'type',
            'color',
            'cornice',
            'door',
            'freize_rez',
            'freize_che',
            'freize_laz',
            'page7',
            'verx',
            'title',
            'sign',
        ];

        return $vars;
    }

    // Рендерит в заданный шаблон все накопленные переменные
    private function returnRender( $varName ) {

        $vars = array(
            'var_name' => $varName
        );

        foreach( $this->getVars() as $var) {
            if ( isset(Yii::$app->response->cookies[$var]) ) {
                $vars[$var] = Yii::$app->response->cookies[$var];
            }
        }

        return $this->render($varName, $vars);
    }

    public function actionType()
    {
        // Инициализируем все переменные, т.к. это первый экшен в цепочке
//        foreach( $this->getVars() as $var ) {
//            setcookie($var, '', time() + 180000);
//        }

        // Название переменной которая определяет все, что будет происходить в этом экшене
        $varName = 'type';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/color');
        }
        return $this->returnRender($varName);
    }

    public function actionColor()
    {
        $varName = 'color';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/cornice');
        }
        return $this->returnRender($varName);
    }

    public function actionCornice()
    {
        $varName = 'cornice';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/door');
        }
        return $this->returnRender($varName);
    }

    public function actionDoor()
    {
        $varName = 'door';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/reize-rez');
        }
        return $this->returnRender($varName);
    }

    public function actionFreizeRez()
    {
        $varName = 'freize_lez';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            $this->setTagCookies(freizeChe, $_POST['freizeChe']);
            return $this->redirect('/altar/freize-laz');
        }
        return $this->returnRender($varName);
    }

    public function actionFreizeLaz()
    {
        $varName = 'freize_laz';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/page7');
        }
        return $this->returnRender($varName);
    }

    public function actionPage7()
    {
        $varName = 'page7';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/verx');
        }
        return $this->returnRender($varName);
    }

    public function actionVerx()
    {
        $varName = 'verx';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/title');
        }
        return $this->returnRender($varName);
    }

    public function actionTitleAltar()
    {
        $varName = 'title';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/sign');
        }
        return $this->returnRender($varName);
    }

    public function actionSignAltar()
    {
        $varName = 'sign';
        if (isset($_POST['process'])) {
            $varValue = $_POST[$varName];
            $this->setTagCookies($varName, $varValue);
            return $this->redirect('/altar/pgf');
        }
        return $this->returnRender($varName);
    }

}
