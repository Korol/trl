<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Catalog;
use frontend\models\CatalogItem;
use frontend\models\ClientCatalogItem;
use yii\helpers\ArrayHelper;
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
        // client info
        $client_name = $this->s->get('client_name');
        $client_id = $this->s->get('client_id');
        // Catalogs list
        $catalogs = Catalog::find()
            ->where('active = :active', [':active' => 1])
            ->orderBy('title ASC')
            ->all();
        if(!empty($catalogs)){
            $catalogs = ArrayHelper::index($catalogs, 'id');
            $catalogs_list = ArrayHelper::map($catalogs, 'id', 'title');
        }
        else{
            $catalogs_list = [];
        }
        // current Catalog ID
        $id = Yii::$app->request->get('id', 0);
        // current Catalog Items
        if(!empty($id)){
            $catalog_items = CatalogItem::find()
                ->where(
                    'active = :active AND catalog_id = :catalog_id',
                    [
                        ':active' => 1,
                        ':catalog_id' => $id,
                    ]
                )
                ->orderBy('id DESC')
                ->all();
            // client full catalog
            $client_catalog = ClientCatalogItem::find()
                ->with('catalogItem')
                ->where(
                    'client_id = :client_id',
                    [
                        ':client_id' => $client_id,
                    ]
                )
                ->orderBy('id ASC')
                ->all();
        }
        else{
            $catalog_items = $client_catalog = [];
        }

        return $this->render('index', compact(
            'client_name', 'client_id', 'catalogs',
            'catalogs_list', 'id', 'catalog_items', 'client_catalog')
        );
    }

    /**
     * save Client Catalog into DB
     */
    public function actionSave()
    {
        $return = 0;
        $client_id = Yii::$app->request->post('client_id');
        $items = Yii::$app->request->post('items');
        if(!empty($items) && !empty($client_id)){
            // split items
            $items_split = explode(',', $items);
            // remove doubles
            $items_uniq = array_unique($items_split);
            // get all Client rows
            $all_rows = ClientCatalogItem::find()
                ->where(
                    'client_id = :client_id',
                    [
                        ':client_id' => $client_id,
                    ]
                )
                ->all();
            $all_rows_keys = (!empty($all_rows)) ? ArrayHelper::getColumn($all_rows, 'catalog_item_id') : [];
            // save new rows
            foreach ($items_uniq as $item){
                // check if item already exists
                if(in_array($item, $all_rows_keys)){
                    continue;
                }
                // else: save it
                $cci_model = new ClientCatalogItem();
                $cci_model->client_id = $client_id;
                $cci_model->catalog_item_id = $item;
                $cci_model->save();
            }
            $return = 1;
        }
        echo $return;
    }

}
