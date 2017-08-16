<?php

namespace backend\controllers;

use Yii;
use backend\models\Catalog;
use backend\models\CatalogSearch;
use backend\models\ImportFile;
use backend\models\CatalogItem;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CatalogController implements the CRUD actions for Catalog model.
 */
class CatalogController extends Controller
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
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catalog model.
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
     * Creates a new Catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Catalog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Catalog model.
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
     * Deletes an existing Catalog model.
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
     * Finds the Catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImport()
    {
        $catalogs = Catalog::findAll(['active' => 1]);
        $catalog_list = (!empty($catalogs)) ? ArrayHelper::map($catalogs, 'id', 'title') : [];
//        $catalog_list[0] = '-- Choose Catalog --';
//        ksort($catalog_list);
        $model = new ImportFile();
        return $this->render('import', compact('catalog_list', 'model'));
    }

    public function actionImportForm()
    {
        // обработка формы
        $importFile = new ImportFile();
        if (Yii::$app->request->isPost) {
            $form = Yii::$app->request->post('ImportFile');
            $importFile->importfile = UploadedFile::getInstance($importFile, 'importfile');
            $filename = 'import_' . date('Y-m-d_H-i-s');
            $full_filename = $filename . '.' . $importFile->importfile->extension;
            if ($importFile->upload($filename)) {
                // file is uploaded successfully
                Yii::$app->session->setFlash('uploadSuccess', Yii::t('app', 'Import file {filename} was successfully uploaded!', ['filename' => $full_filename]));
                $this->importIntoDB($form['catalog_id'], $full_filename);
            }
            else{
                Yii::$app->session->setFlash('uploadError', Yii::t('app', 'Import file {filename} has upload error!', ['filename' => $full_filename]));
                $this->redirect(['import']);
            }
        }
    }

    public function importIntoDB($catalog_id, $file)
    {
        /**
         * Поля в xlsx-файле (+ это те, которые импортитуем в БД)
         * 1. название продукта +
         * 2. изображение +
         * 3. SKU +
         * 4. спецификации +
         * 5. расположение +
         * 6. Количество мест +
         * 7. количество шт
         * 8. Количество мест + количество шт
         * 9. Комментарии
         */

        // очистка каталога
        CatalogItem::deleteAll(['catalog_id' => $catalog_id]);

        //  Include PHPExcel
        include '../../vendor/novikov/phpexcel/Classes/PHPExcel.php';
        $inputFileName = './import/' . $file;

        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();

        $importCounter = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            if(!empty($objWorksheet->getCellByColumnAndRow(0, $row)->getValue())) {
                $model = new CatalogItem();
                $model->catalog_id = $catalog_id;
                $model->name = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
//                $model->image = $this->cleanImageLink($objWorksheet->getCellByColumnAndRow(1, $row)->getValue());
                $model->image = $this->saveImage($objWorksheet->getCellByColumnAndRow(1, $row)->getValue());
                $model->sku = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                $model->specification = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
                $model->placement = $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
                $model->places_num = $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
                $model->save();
                $importCounter++;
            }
            else{
                continue;
            }
        }

        if($importCounter > 0)
            Yii::$app->session->setFlash('importSuccess', Yii::t('app', 'Import of file {filename} was successfully! Added {num} rows.',
                ['filename' => $file, 'num' => $importCounter])
            );
        else
            Yii::$app->session->setFlash('importError', Yii::t('app', 'Import of file {filename} failed!', ['filename' => $file]));

        $this->redirect(['import']);
    }

    public function cleanImageLink($link)
    {
        if(strpos($link, 'dl=0') !== false){
            // dropbox image link
            $link = str_replace('dl=0', 'raw=1', $link);
        }
        if(strpos($link, 'open?id=') !== false){
            // google drive v1
            $link_ex = explode('open?id=', $link);
            $link = 'https://drive.google.com/uc?export=view&id=' . $link_ex[1];
        }
        if(strpos($link, '/file/d/') !== false){
            // google drive v2
            $link_ex = explode('/file/d/', $link);
            $link_ex2 = (strpos($link_ex[1], '/view') !== false) ? explode('/view', $link_ex[1]) : '';
            $link = 'https://drive.google.com/uc?export=view&id=' . ((!empty($link_ex2[0])) ? $link_ex2[0] : $link_ex[1]);
        }
        return $link;
    }

    public function saveImage($url)
    {
        $return = '';
        $path = '/import_images/';
        if(!empty($url)){
            $url = $this->cleanImageLink($url);
            $filename = 'img_' . md5($url) . '.jpg';
            if(!file_exists('.' . $path . $filename)){
                $content = file_get_contents($url);
                file_put_contents($path . $filename, $content);
            }
            $return = $path . $filename;
        }
        return $return;
    }
}
