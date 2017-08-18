<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CatalogItem;
use yii\web\Controller;
use frontend\models\ClientCatalogItem;
use frontend\models\MfilesTrello;
use frontend\models\ClientOrder;
use frontend\models\ClientOrderItem;
use frontend\models\Mfiles;
use kartik\mpdf\Pdf;

// TODO: переделать сохранение каталогов клиента с CatalogItemID на SKU!!!!
class OrderController extends Controller
{
    // Переменная для хранения сессии
    private $s;
    // временная директория для фото с M-files
    public $tmp_img_path = './_tmp/';

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
        // $catalog_items = items from Design directory on M-files
        $catalog_items = [];
        $mfilesTrello = new MfilesTrello();
        $cat_items = $mfilesTrello->getImagesSearch();
        if(!empty($cat_items['result'])){
            foreach ($cat_items['result'] as $ci_key => $cat_item) {
                $catalog_items[$ci_key] = $cat_item;
                // сохраняем фото во временнную директорию
                $this->save_img($cat_item);
                $catalog_items[$ci_key]['img'] = $this->tmp_img_path . $cat_item['id1'] . '_' . $cat_item['id2'] . '.jpg';
            }
        }
        // каталог клиента на сайте
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

        return $this->render('index', compact(
            'client_name', 'client_id', 'client_catalog', 'catalog_items'
            )
        );
    }

    /**
     * сохраняем Заказ в DB
     */
    public function actionSave()
    {
        $return = 0;
        $client_id = Yii::$app->request->post('client_id');
        $items = Yii::$app->request->post('items');
        if(!empty($items) && !empty($client_id)){
            // заказ
            $clientOrder = new ClientOrder();
            $clientOrder->client_id = $client_id;
            $clientOrder->created = date('Y-m-d H:i:s');
            $clientOrder->save();
            // товары в заказ
            $items_split = explode(',', $items);
            $order_items = [];
            // обрабатываем товары
            foreach ($items_split as $item) {
                // делим на ID товара и тип: design (с M-files) или catalog (с сайта)
                $item_split = explode(':', $item);
                if(!empty($order_items[$item_split[0]])){
                    // такой товар уже есть в заказе – увеличиваем его количество
                    $order_items[$item_split[0]]['qty']++;
                }
                else{
                    // если тип == design – проверяем поиском по имени картинки, есть ли товар в БД
                    if($item_split[1] == 'design'){
                        $itm = CatalogItem::find()->where(['like', 'image', $item_split[0]])->one();
                        if(empty($itm))
                            continue; // товара нет в БД – пропускаем, такой товар в заказ не идёт
                        else{
                            $item_split[0] = $itm->sku;
                        }
                    }
                    // добавляем товар в заказ
                    $order_items[$item_split[0]] = [
                        'client_id' => $client_id,
                        'order_id' => $clientOrder->id,
                        'catalog_item_id' => $item_split[0],
                        'type' => ($item_split[1] == 'design') ? 'design' : 'catalog',
                        'qty' => 1,
                    ];
                }
            }
            // добавляем товары в заказ
            if(!empty($order_items)){
                foreach ($order_items as $order_item) {
                    $clientOrderItem = new ClientOrderItem();
                    $clientOrderItem->client_id = $order_item['client_id'];
                    $clientOrderItem->order_id = $order_item['order_id'];
                    $clientOrderItem->catalog_item_id = $order_item['catalog_item_id'];
                    $clientOrderItem->type = $order_item['type'];
                    $clientOrderItem->qty = $order_item['qty'];
//                    $session = Yii::$app->session;
//                    // проверяем и получаем данные из сессии – если они там есть, по CatalogItemID
//                    if ($session->has('item_' . $order_item['catalog_item_id'])){
//                        $clientOrderItem->comment = (!empty($session['item_' . $order_item['catalog_item_id']]['comment']))
//                            ? $session['item_' . $order_item['catalog_item_id']]['comment']
//                            : '';
//                        $clientOrderItem->placement = (!empty($session['item_' . $order_item['catalog_item_id']]['placement']))
//                            ? $session['item_' . $order_item['catalog_item_id']]['placement']
//                            : '';
//                        $clientOrderItem->places_num = (!empty($session['item_' . $order_item['catalog_item_id']]['places_num']))
//                            ? $session['item_' . $order_item['catalog_item_id']]['places_num']
//                            : 0;
//                        $session->remove('item_' . $order_item['catalog_item_id']);
//                    }
                    $clientOrderItem->save();
                }
                // формируем PDF и отправляем на email и M-files
                // TODO: не PDF - а XML
                $this->actionCreatePdf($clientOrder->id);
            }
            $return = 1;
        }
        echo $return;
    }

    /**
     * Сохраняем картинку во временную директорию _img.cache
     * @param array $image
     */
    public function save_img($image)
    {
        try
        {
            $file = $this->tmp_img_path . $image['id1'] . '_' . $image['id2'] . '.jpg';
            if(!file_exists($file))
            {
                $mfilesTrello = new MfilesTrello();
                $file_lv = 'http://mfiles.lavi.co.il/REST/objects/0/' . $image['id1'] . '/1/files/' . $image['id2'] . '/content?extensions=mfwa';
                $fl = $mfilesTrello->return_binary_by_get_request($file_lv);
                file_put_contents($file, $fl);
            }
        } catch (Exception $e){}

    }

    /**
     * создание файла заказа
     * @param int $order_id
     * TODO: не PDF - а XML
     */
    public function actionCreatePdf($order_id = 5)
    {
        // информация о текущем клиенте
        $client_name = $this->s->get('client_name');
        $client_id = $this->s->get('client_id');
        $fileName = $client_id . '_order-' . $order_id . '_' . time();

        // заказ
        $order = ClientOrder::find()
            ->with('clientOrderItem')
            ->where([
                'id' => $order_id
            ])
            ->one();
        $content = '<h2>Order #' . $order_id . '</h2>';
        $content .= '<em style="color: darkslategrey;">Created: ' . $order['created'] . '</em>';
        $content  .= '<table  width="100%" cellpadding="5" border="1" style="margin-top: 15px;">';
        if(!empty($order->clientOrderItem)){
            foreach ($order->clientOrderItem as $item) {
                // товар
                $item_info = CatalogItem::find()
                    ->where([
                        'sku' => $item['catalog_item_id']
                    ])
                    ->one();
                if(!empty($item_info)){
                    // строка в таблице
                    $image_link = (!empty($item_info['image']))
                                    ? Yii::$app->urlManager->hostInfo . ltrim($item_info['image'], '.')
                                    : '';
                    $content .= '<tr>';
                    $content .= '<td><img style="max-width: 200px;" src="' . $image_link . '" alt="' . $item_info['name'] . '"/></td>';
                    $content .= '<td nowrap="nowrap" align="left" style="width: 300px;font-family: freesans">';
                    $content .= 'Name: ' . $item_info['name'] . '<br>';
                    $content .= 'SKU: ' . $item_info['sku'] . '<br>';
                    $content .= 'Specification: ' . $item_info['specification'] . '<br>';
                    $content .= 'Placement: ' . $item_info['placement'] . '<br>';
                    $content .= 'Places number: ' . $item_info['places_num'] . '<br>';
                    $content .= 'Comment: ' . $item_info['comment'] . '<br>';
                    $content .= '</td>';
                    $content .= '</tr>';
                }

            }
        }
        $content .= '</table>';
//        echo $content;
//        die;

        // Генерируем выходной pdf-файл
        $pdf = new Pdf([
            'filename' => '../../_result.pdf.cache/'. $fileName .'.pdf',
            'destination' => 'F',

            'mode' => Pdf::MODE_BLANK, // leaner size using standard fonts
            'cssFile' => 'vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'content' => $this->renderPartial('pdf',
                [
                    'content' => $content,
                    'title' => 'Order: ' . $order_id,
                    //'signFilePath' => $signFilePath,
                ]),
            'options' => [
                'title' => 'Lavi Altar forms',
                'subject' => 'Generating by Lavi comp'
            ],
            'methods' => [
                'SetHeader' => ['Lavi comp. ' . date("r")],
                'SetFooter' => ['|' . date("r")],
            ]
        ]);

        $pdf->render();

        $saved_file_id = $this->sendToMfiles($fileName);
        // TODO: отправка ссылки на файл по E-mail заказчику/оператору

    }

    /**
     * отправка файла на M-files
     * @param $filename
     * @return mixed|string
     */
    public function sendToMfiles($filename)
    {
        // информация о текущем клиенте
        $client_name = $this->s->get('client_name');
        $client_id = $this->s->get('client_id');

        $mfiles = new Mfiles();
        $mfiles->extantion = 'pdf';
        // имя файла upload
        $fileNameMfiles = $client_name . '_' . $filename;
        // собранный файл грузим на фмафлс

        $file_id = $mfiles->upload_file_by_name_in_folder(
            $fileNameMfiles,
            file_get_contents('../../_result.pdf.cache/' . $filename . '.pdf'),
            $client_id,
            $client_name,
            '0',
            'הזמנה זמני'
        // ЭТО НЕОБЯЗАТЕЛЬНЫЕ МЕТАДАННЫЕ ДЛЯ СОЗДАНИЯ СЛОЖНОГО ОБЪЕКТА В МФАЙЛС
        // ЭТО НЕОБЯЗАТЕЛЬНЫЕ МЕТАДАННЫЕ ДЛЯ СОЗДАНИЯ СЛОЖНОГО ОБЪЕКТА В МФАЙЛС
        // ЭТО НЕОБЯЗАТЕЛЬНЫЕ МЕТАДАННЫЕ ДЛЯ СОЗДАНИЯ СЛОЖНОГО ОБЪЕКТА В МФАЙЛС
        // ЭТО НЕОБЯЗАТЕЛЬНЫЕ МЕТАДАННЫЕ ДЛЯ СОЗДАНИЯ СЛОЖНОГО ОБЪЕКТА В МФАЙЛС
//            $classname_multfolder_pd100 = $form_fields_from_db['mfiles_meta_class_id'],//'לביצוע', // соотве ади смотри в аяксе выпадающего меню формы
//            $dropdwn_filed_pd1093 = $form_fields_from_db['mfiles_meta_dropdwn_001_id'],//'מכירות',
//            $dropdwn_filed_pd1133 = $form_fields_from_db['mfiles_meta_dropdwn_002_id'] //'שולחן קריאה'
        );

        // test
//        if(!empty($file_id)){
//            echo '<h4>PDF saved to Mfiles directory: <a href="http://mfiles.lavi.co.il/Default.aspx?#F9930A12-4EE5-473F-A871-CADEE360639E/object/' . $file_id . '/latest">here</a></h4>';
//        }
//        else{
//            echo 'File NOT saved into M-files!';
//        }
        return (!empty($file_id)) ? $file_id : '';
    }

}
