<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Catalog;
use frontend\models\CatalogItem;
use frontend\models\ClientCatalogItem;
use yii\helpers\ArrayHelper;

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
        // информация о текущем клиенте
        $client_name = $this->s->get('client_name');
        $client_id = $this->s->get('client_id');
        // список Каталогов
        $catalogs = Catalog::find()
            ->where('active = :active', [':active' => 1])
            ->orderBy('id ASC')
            ->all();
        if(!empty($catalogs)){
            $catalogs = ArrayHelper::index($catalogs, 'id');
            $catalogs_list = ArrayHelper::map($catalogs, 'id', 'title');
        }
        else{
            $catalogs_list = [];
        }
        // ID текущего Каталога
        $id = Yii::$app->request->get('id', 0);
        // элементы текущего Каталога
        if(!empty($id)){
            $catalog_items = CatalogItem::find()
                ->where(
                    'catalog_id = :catalog_id',
                    [
                        ':catalog_id' => $id,
                    ]
                )
                ->orderBy('id ASC')
                ->all();
            // Каталог Клиента
            $client_catalog = ClientCatalogItem::find()
                ->with('catalogItem')
                ->where(
                    'client_id = :client_id',
                    [
                        ':client_id' => $client_id,
                    ]
                )
                ->orderBy('id ASC')
                ->all();//var_dump($client_catalog);die;
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
     * сохраняем Каталог в DB
     */
    public function actionSave()
    {
        $return = 0;
        $client_id = Yii::$app->request->post('client_id');
        $items = Yii::$app->request->post('items');
        if(!empty($items) && !empty($client_id)){
            $items_split = explode(',', $items);
            // удаляем дубли
            $items_uniq = array_unique($items_split);
            // все записи Клиента
            $all_rows = ClientCatalogItem::find()
                ->where(
                    'client_id = :client_id',
                    [
                        ':client_id' => $client_id,
                    ]
                )
                ->all();
            $all_rows_keys = (!empty($all_rows)) ? ArrayHelper::getColumn($all_rows, 'catalog_item_id') : [];
            // сохраняем новые записи
            foreach ($items_uniq as $item){
                // если такая запись уже есть – пропускаем
                if(in_array($item, $all_rows_keys)){
                    continue;
                }
                // если нет – сохраняем
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
