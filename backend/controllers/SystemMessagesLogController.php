<?php

namespace backend\controllers;

use Yii;
use backend\models\SystemMessagesLog;
use backend\models\SystemMessagesLog_Search;

//use common\models\Provider;
//use common\models\Provider_Search;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\base\Exception;

 use yii\filters\AccessControl;



/**
 * SystemMessagesLogController implements the CRUD actions for SystemMessagesLog model.
 */
class SystemMessagesLogController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

            // use yii\filters\AccessControl;
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // этот экшен не закрыт автоизацией
                    /*[
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                ]
            ],


        ];
    }


    /**
     * Lists all SystemMessagesLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SystemMessagesLog_Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id_message' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = 100;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SystemMessagesLog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SystemMessagesLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SystemMessagesLog();
        $model->date_message = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_message]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    // для аякса в таблице отображения
    public function actionDumpDetail()
    {
        // вырубим бо неэффективно для больших дампов
        if (isset($_POST['expandRowKey']) AND 0) {
//            $model = \app\models\Book::findOne($_POST['expandRowKey']);
//            return $this->renderPartial('_book-details', ['model'=>$model]);
            $model = \backend\models\SystemMessagesLog::findOne($_POST['expandRowKey']);

            $b = $model->body_message;
            $b = preg_replace('/<script([^\'"]|"(\\.|[^"\\\])*"|\'(\\\.|[^\'\\\])*\')*?<\/script>/ui', '', $b);
            $b = preg_replace('/<link\s+rel="([^>]*)>/ui', '', $b);
            if (strlen($model->body_message) <> strlen($b)) {
                return $b;
            } else {
                return "<pre>" . $model->body_message . "</pre>";
            }
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }


    /////////////////////////

    static function logger($type, $line, $log_path = './_logs')
    {
        // защита от дурака
        if (is_array($line)) $line = json_encode($line);
        if (is_array($type)) $type = json_encode($type);

        if (!file_exists($log_path)) {
            mkdir($log_path, 0777, true);
        }

        $url = $log_path . "/" . $type . ".html";
        $fd = fopen($url, "a");
        fwrite($fd, "" . date("Ymd G:i:s") . " - " . $line . "\n");
        //fwrite($fd, " *** Cookies - " . json_encode($_COOKIES) . "\n");
        //fwrite($fd, " *** Session - " . json_encode($_SESSION) . "\n\n\n");


        fclose($fd);
        // путь куда сохранили возвоащаем
        return $url;

    }//func


    //
    static function Save($imp, $from, $subj, $body = '')
    {

        // отклчаем
        //return TRUE;


        $model = new SystemMessagesLog();

        $from = "[" . round(Yii::getLogger()->getElapsedTime()) . "s] " . $from . "";

        $model->date_message = date("Y-m-d H:i:s");
        $model->importance_message = $imp;
        $model->from_message = $from;
        $model->id_message = 0;
        // ограничения утф поля TEXT MySQL 21,844
        //$model->body_message = substr($body, 0, 21800);

        // передали нам дам??
        if ($body <> '') {
            //чистм хтмл
            $b = preg_replace('/<script([^\'"]|"(\\.|[^"\\\])*"|\'(\\\.|[^\'\\\])*\')*?<\/script>/ui', '', $body);
            $b = preg_replace('/<link\s+rel="([^>]*)>/ui', '', $b);
            // а это реально был хтмл?
//            if (strlen($body) == strlen($b)) {
//                $b = "<pre>" . $b . "</pre>";
//            }
            //$b = $body;

            //
            // важно для консоли в параметра абсолютный путь указать
            if (isset(Yii::$app->params['abs_log_path'])) {
                $log_url = Yii::$app->params['abs_log_path'] . '/_logs/all';
            } else {
                $log_url = './_logs/all';
            }

            $url_dump = SystemMessagesLogController::logger(time() . "_" . md5($subj.time()), $b, $log_url);
        }

        if (isset($url_dump)) {

            if (isset(Yii::$app->params['abs_log_path'])) {
                //отрежем обратно абсолют на относительный путь
                $url_dump = str_replace(
                    Yii::$app->params['abs_log_path'] . '/',
                    '',
                    $url_dump
                );
            }


            $subj = $subj . " <a target=_blank href=/" . $url_dump . ">дамп</a>";
        }
//        else {
//            $subj = $subj . " [дамп пустой]";
//        }

        $f_header_start = "";
        $f_header_stop = "";
        //0 просто мессадж серым
        //1 ключевое сообщение зеленым
        //2 красный варанинг
        //3 красный ЖИРНЫМ фатал

        if ($imp == 0) {
            $color = "gray";
        }
        // писец ошибка
        if ($imp == 1) {
            $color = "green";
        }
        if ($imp == 2) {
            $color = "red";
        }
        if ($imp == 3) {
            $color = "red";
            $f_header_start = "<h2>";
            $f_header_stop = "</h2>";
        }

        $model->subj_message = $subj;
        echo "<br><br>\r\n\r\n * <font color=green><b> $from </b></font>";
        echo "<br>\r\n";
        echo "<br>\r\n $f_header_start <font color=$color>$subj</font> $f_header_stop ";


        // заливаем в базу
        try {
            // якась хня почему пропускает - не разбирался но вроде работает
            if ($model->save(false)) {
            } // ловим дубли уникальных ключей в базе - повторные записи
        } catch (Exception $e) { // не забудь use yii\base\Exception; !!
            $model->addError(null, $e->getMessage());
            $message = $e->getMessage();
            print_r($message);
        }

    }


    /**
     * Updates an existing SystemMessagesLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_message]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SystemMessagesLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBulkdelete()
    {

        if (sizeof($_POST) > 0) {

            SystemMessagesLog::deleteAll();

            // логи дампов ошибок
            $files = glob('./_logs/all/*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }

        }
        return $this->redirect(['index']);

    }


    /**
     * Finds the SystemMessagesLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SystemMessagesLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SystemMessagesLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
