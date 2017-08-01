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
class SeatsController extends Controller
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

   public function actionIndex($type=1)
   {
       return $this->render('index',['type'=>$type]);
   }

}
