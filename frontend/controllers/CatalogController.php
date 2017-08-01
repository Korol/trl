<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
//use frontend\models\Mfiles;

class CatalogController extends Controller
{
    // Переменная для хранения сессии
    private $s;

    public function beforeAction($action)
    {
        $this->s = Yii::$app->session;
        $cookies = Yii::$app->request->cookies;

        // Проверяем наличие установленного клиента в куках
        $clientId = $cookies->getValue('dir_id_mfiles');
        if ( $clientId == null ) {
            return $this->redirect("/site/client")->send();
        }

        // Запихиваем клиента в сессию
        $this->s->set('client_id', $cookies->getValue('dir_id_mfiles'));
        $this->s->set('client_name', $cookies->getValue('dir_name_mfiles'));

        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $client_name = $this->s->get('client_name');
        $client_id = $this->s->get('client_id');
        return $this->render('index', compact('client_name', 'client_id'));
    }

}
