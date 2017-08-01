<?php

namespace frontend\controllers;

use Yii;
use common\models\Googleforms;
use common\models\GoogleformsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoogleformsController implements the CRUD actions for Googleforms model.
 */
class GoogleformsController extends Controller
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
        ];
    }

    /**
     * Lists all Googleforms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoogleformsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Googleforms model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {

//        $this->view->registerJsFile('/js/sketch.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        if (!$client_id) {
            return $this->redirect("/site/client");
            return true;
        }


        $cookies = Yii::$app->request->cookies;
        $client_id = $cookies->getValue('dir_id_mfiles');
        $client_name = $cookies->getValue('dir_name_mfiles');

        return $this->render('view', [
            'client_id' => $client_id,
            'client_name' => $client_name,
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Googleforms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Googleforms();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Googleforms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Googleforms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
