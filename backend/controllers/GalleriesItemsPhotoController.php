<?php

namespace backend\controllers;

use Yii;
use common\models\GalleriesItemsPhoto;
use common\models\GalleriesItemsPhotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleriesItemsPhotoController implements the CRUD actions for GalleriesItemsPhoto model.
 */
class GalleriesItemsPhotoController extends Controller
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
     * Lists all GalleriesItemsPhoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GalleriesItemsPhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GalleriesItemsPhoto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    // берет из папки на фтп фотки и пиъхает в заданную галларею
    public function actionBulkCreate___()
    {


        // запускать единожды и аккуратно
        // бо льет в базу фотки

        foreach (glob("/home/lavi/public_html/frontend/web/_making_photos/*.PNG") as $img_from) {
            preg_match('/([^\/]+\.PNG)/', $img_from, $d);
            $img = $d[1];

            echo $hash = md5($img_from);
            echo "<br>";
            echo $path = "/home/lavi/public_html/frontend/uploads/store/" . $hash[0] . "" . $hash[1] . "/" . $hash[3] . "" . $hash[4] . "/" . $hash[6] . "" . $hash[7] . '/';
            echo "<br>";

            echo $img_to = $path . '' . $hash . ".png";
            GalleriesItemsPhotoController::createPath($path);
            copy($img_from, $img_to);
            $file_size = filesize($img_from);

            $req = "INSERT INTO `my_galleries_items_photo` VALUES('', 1, '" . $img . "', 0);";
            Yii::$app->db->createCommand($req)->query();
            $id = Yii::$app->db->getLastInsertID();


            //INSERT INTO `attach_file` VALUES(60, ' лэйаута Персонального кабинета 2', 'GalleriesItemsPhoto', 37, '4f0bc2334a1900aa03a4a0657b9a6e8d', 238650, 'png', 'image/png');
            $req = "INSERT INTO `attach_file` VALUES('', '" . $img . "', 'GalleriesItemsPhoto', $id, '" . $hash . "', " . $file_size . ", 'png', 'image/png');";
            Yii::$app->db->createCommand($req)->query();

        }

    }


    static function createPath($path)
    {
        if (is_dir($path)) return true;
        $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1);
        $return = GalleriesItemsPhotoController::createPath($prev_path);
        return ($return && is_writable($prev_path)) ? mkdir($path) : false;
    }

    /**
     * Creates a new GalleriesItemsPhoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new GalleriesItemsPhoto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_item]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'gallery' => $id
            ]);
        }
    }

    /**
     * Updates an existing GalleriesItemsPhoto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // Костыль для модуля аплоуда - в базе по другому поле  наывается
        $model->id = $model->id_item;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_item]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'gallery' => $model->gallery_id
            ]);
        }
    }

    /**
     * Deletes an existing GalleriesItemsPhoto model.
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
     * Finds the GalleriesItemsPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GalleriesItemsPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GalleriesItemsPhoto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
