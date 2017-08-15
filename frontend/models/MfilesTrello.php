<?php

namespace frontend\models;

use Yii;


class MfilesTrello
{
    public $debug = false;
    // папка с клиентами
    public $root_dir_path = 'V6914'; // из адреса вида http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/V6914/L12651/L8/L12
    // пользователь от которого скрипт работает в системе
    public $login = 'oren';
    public $pass = '3359100';
    // расширение файлов хранится отдельно для аплоуда
    public $extantion = 'txt';


    const Uninitialized = 0;
    const Text = 1;
    const Integer = 2;
    const Floating = 3;
    const Date = 5;
    const Time = 6;
    const Timestamp = 7;
    const Boolean = 8;
    const Lookup = 9;
    const MultiSelectLookup = 10;
    const Integer64 = 11;
    const FILETIME = 12;
    const MultiLineText = 13;
    const ACL = 14;

    /*
     * методы из проекта Photo Mark
     */

    /**
     *
     * $url = 'http://mfiles.lavi.co.il/REST/views/V6914/items.aspx';
     * возвращает список папок (mfiles_id, mfiles_name) в заданой в классе рутовой директории
     */
    public function reading_dir_by_path_json_array()
    {

        // как реадизовать пагинацию  - хер его знает
        //толко первых 200 выдает

        $url = 'http://mfiles.lavi.co.il/REST/views/' . trim($this->root_dir_path, '/ ') . '/items.aspx';
        //
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-type: application/json',
//    'ContentType: application/json',
//    'dataType: json',
            'X-Authentication: ' . $this->getAuthToken(),
            'X-Extensions: MFWA',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Requested-With: XMLHttpRequest',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
        ));

        $output_2 = curl_exec($ch);
        $a = json_decode($output_2, true);
        //if ($this->debug) print_r($a);
        curl_close($ch);
        $result = [];
        foreach ($a['Items'] as $row) {
            $result[] = [
                'id' => $row['PropertyFolder']['Lookup']['Item'],
                'name' => $row['PropertyFolder']['Lookup']['DisplayValue']
            ];
        }
        return $result;
    }

    public function search_in_dir_by_tags($tags)
    {
        // остановися на последнем вариенте - поиск только папок класса КЛИЕНТ
        // но их создает заказчик самостоятельно
        // скрипт не создает

        // содержит в  названии этот фрагмент
        // $params = '?limit=500&00_p0*=' . $name; // не использую

        //  фрагмент в начале названия class =  00_p100

        //http://mfiles.lavi.co.il/REST/objects/0/183584/1/files/187310/content?extensions=mfwa&active-vault=F9930A12-4EE5-473F-A871-CADEE360639E
        $gt = '';
        foreach ($tags as $key=>$val)
        {
            if($val)
                $gt .= '&00_p'.$key.'='.$val;
        }

        $params = '?limit=10000&0_qbn=_sjpg_p20_spng_p20_sgif_p20_sjpeg'.$gt;//; // не использую

        // ищем только папки созданные клиентом - я такие так и не научился создавать даже в ручну.!!!
        //$params = '?limit=500&0_o=102&00_p0^=' . $name;
        // не все документы - а только хранилище клиентов
        $url = 'http://mfiles.lavi.co.il/REST/views/_tempsearch/searchws.aspx' . $params;var_dump($url);

        //echo "Result M-files <a href='http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/_tempsearch" . $params . "'>here</a>";


        //
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-type: application/json',
//    'ContentType: application/json',
//    'dataType: json',
            'X-Authentication: ' . $this->getAuthToken(),
            'X-Extensions: MFWA',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Requested-With: XMLHttpRequest',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
        ));

        $output_2 = curl_exec($ch);

        $a = json_decode($output_2, true);


//        print_r($a);
//        exit;
        curl_close($ch);

        if (isset($a['Items']['0'])) {
            foreach ($a['Items'] as $item) {
                $result_items[] = [
                    'id1' => $item['ObjectVersion']['ObjVer']['ID'],
                    'id2' => $item['ObjectVersion']['Files'][0]['ID'],
                ];
            }
            $result = [
                'error' => false,
                'result' => $result_items,
            ];

        } else {

            $result = [
                'error' => true,
                'result' => [],
            ];

        }
        return $result;

    }

    /**
     * поиск клиентов по директории
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function search_in_dir_by_title_name($name)
    {


        $name = urlencode($name);
        // остановимся на последнем варианте - поиск только папок класса КЛИЕНТ
        // но их создает заказчик самостоятельно
        // скрипт не создает

        // содержит в названии этот фрагмент
        $params = '?limit=500&00_p0*=' . $name; // не использую

        //  фрагмент в начале названия
        $params = '?limit=500&00_p0^=' . $name; // не использую

        // ищем только папки созданные киентом - я такие так и не научился создавать даже в ручную!!!
        $params = '?limit=500&0_o=102&00_p0^=' . $name;
        // не все документы а только хранлище клиентов
        $url = 'http://mfiles.lavi.co.il/REST/views/_tempsearch/searchws.aspx' . $params;

        //echo "Result M-files <a href='http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/_tempsearch" . $params . "'>here</a>";


        //
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-type: application/json',
//    'ContentType: application/json',
//    'dataType: json',
            'X-Authentication: ' . $this->getAuthToken(),
            'X-Extensions: MFWA',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Requested-With: XMLHttpRequest',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
        ));

        $output_2 = curl_exec($ch);

        $a = json_decode($output_2, true);


//        print_r($a);
//        exit;
        curl_close($ch);

        if (isset($a['Items']['0'])) {
            foreach ($a['Items'] as $item) {
                $result_items[] = [
                    'id' => $item['ObjectVersion']['ObjVer']['ID'],
                    'name' => $item['ObjectVersion']['Title'],
                ];
            }
            $result = [
                'error' => false,
                'result' => $result_items,
            ];

        } else {

            $result = [
                'error' => true,
                'result' => [],
            ];

        }


        return $result;

    }

    /**
     * авторизация на M-files
     */
    public function getAuthToken()
    {
        $params = array(
            "Username" => $this->login,
            "Password" => $this->pass,
            "WindowsUser" => false,
        );

        $postData = json_encode($params);
        $url = 'http://mfiles.lavi.co.il/REST/server/authenticationtokens';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// НЕ ОТКЛЮЧАТЬ - не увидишь куки в хидере
//curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'ContentType: application/json',
            'dataType: json',
        ));

// мы авторизовались??
        $output_2 = curl_exec($ch);
        $a = json_decode($output_2, true);
        curl_close($ch);

        if (isset($a['Value'])) {
            // если Vault не указан читаем корневой и получаем его токен и UID
            $url = 'http://mfiles.lavi.co.il/REST/server/vaults';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-type: application/json',
//    'ContentType: application/json',
//    'dataType: json',
                'X-Authentication: ' . $a['Value'],
            ));

            /**
             * (
             * [0] => Array
             * (
             * [Name] => Lavi
             * [GUID] => {F9930A12-4EE5-473F-A871-CADEE360639E}
             * [Authentication] => dnrEv-Z4IdRNCRDzLRJY_jVxuFksFnc_Wu2tBJxaXNCFdGuPN1unB8-bMcopn_8wVZrrG3BOM2azSApbJ0fgNN0ZwY48ROzAZlpvxMV-tXxX5dTP8EBXN9wShkIiyY4hUmdJomSbpKyz-B4Xb-ZLsA8bsrtCWQlCSYFBoCu91EBVtR6y86DegfjxMWvyDbYDQvxrM-Ux9ugA0HLXP8C0fqkEnH4xai0M9Q2S8cFDC1cbn5SFlTb0BrN7kXCk04m6gv8G1s6QCBHT66FhpX6UvMp1uua117T4do1xVdr0bcoEs2jFZxX9OyRW2DF0_VUKPBSZoPEbKnaVtwoZEXGtWQ
             * )
             */
            $output_2 = curl_exec($ch);
            $a = json_decode($output_2, true);
//        print_r($a);
            curl_close($ch);
            if (isset($a['0']['Authentication'])) {
                return $a['0']['Authentication'];
            } else {
                echo "Authentification SET 2 Error! No Vaults ID";
            }
        } else {
            echo "Authentification SET 1 Error! No Token";
        }
    }

    /**
     * скачивает картинку (файл) с M-files
     * $url
     */
    public function return_binary_by_get_request($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
//curl_setopt($ch, CURLOPT_COOKIEFILE, $file_cookies);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $file_cookies);s
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_STDERR, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-type: image/jpeg',
//    'ContentType: application/json',
//    'dataType: json',
            'X-Authentication: ' . $this->getAuthToken(),
        ));

        $output_2 = curl_exec($ch);
        curl_close($ch);
        //header('Content-type: image/jpeg');
        //header('Content-length: ' . strlen($output_2));
        //header('Content-Disposition: attachment; filename="downloaded.jpg"');
        return $output_2;

    }


    /**
     * My methods
     */

    /*
     * Требования к файлам Дизайн для Клиентов (на примере 4566):
     * 1. В папке Клиента создаётся мультифайловый документ (иконка зеленая книжка) с названием Дизайн (עיצוב)
     * 2. Для этого документа устанавливаются мета-данные:
     *      Класс: מסמך כללי - עיצוב  (ID: 19)
     *      Name of title: עיצוב
     *      Клиент (עיצוב): имя клиента (4566 - פיתוח כלי מכירה - לביא)
     * 3. Далее в этот мультифайловый документ можно загружать любое количество фото –
     *      при этом все они будут автоматически наследовать родительские мета-данные, указанные выше.
     * 4. Эти файлы мы и будем подтягивать в первую колонку при создании Заказа.
     * 5. Указанные выше мета-данные фотографий – не изменять, поиск файлов идёт по:
     *      ID класса (19)
     *      Name of title: עיצוב
     *      ID клиента (который система получает сама, по имени Клиента)
     */

    /**
     * выполняет GET запрос через cURL
     * @param $url
     * @param bool $array
     * @return mixed
     */
    public function curlGetQuery($url, $array = true)
    {
        // cURL запрос
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Authentication: ' . $this->getAuthToken(),
            'X-Extensions: MFWA',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Requested-With: XMLHttpRequest',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return ($array) ? json_decode($response, true) : $response;
    }

    /**
     * возвращает массив элементов в поле Items результатов cURL-запроса
     * @param $result
     * @return array
     */
    public function getItems($result)
    {
        $return = [];
        if(!empty($result['Items'])){
            foreach ($result['Items'] as $item) {
                $return[] = $item;
            }
        }
        return $return;
    }

    /**
     * список представлений (директорий) в корне хранилища
     * @return array
     */
    public function getRootItems()
    {

        $url = 'http://mfiles.lavi.co.il/REST/views/items.aspx';
        $result = $this->curlGetQuery($url);

        return $this->getItems($result);

        /*
Поставщики                                    112: ספקים
Продажи - Зарубежные                          118: מכירות - חו"ל
Продажи                                       131: מכירות
Пометка фотографий                            144: תיוג תמונות
Документы Правила                             414: מסמכים כללים
изображения клиента                           2399: תמונות לקוחות
Пометка изображений                           2407: תיוג הדמיות
Маркировочные моделирование - Отдел дизайна   3614: תיוג הדמיות - מחלקת עיצוב
Клиенты                                       6914: לקוחות
         */
    }

    /**
     * список виртуальных директорий Клиентов
     * @return array
     */
    public function getClientsDirItems()
    {
        // 200 only?
        $url = 'http://mfiles.lavi.co.il/REST/views/' . $this->root_dir_path . '/items.aspx';
        $result = $this->curlGetQuery($url);

        return $this->getItems($result);
    }

    /**
     * список виртуальных директорий из директории Клиента
     * @param $id
     * @return array
     */
    public function getClientDir($id)
    {
        $url = 'http://mfiles.lavi.co.il/REST/views/' . $this->root_dir_path . '/L' . $id . '/items.aspx';
        $result = $this->curlGetQuery($url); // echo '<pre>';print_r($result);echo '</pre>';

        return $this->getItems($result);

//        качество    איכות
//        инженерия   הנדסה
//        выполнение  לביצוע
//        продажи     מכירות
//        связи       תכתובות
    }

    /**
     * Список доступных Классов (Classes)
     * 100 – идентификатор мета-свойства Класс
     * @return mixed
     */
    public function getClasses()
    {
        $url = 'http://mfiles.lavi.co.il/REST/structure/classes';
        $result = $this->curlGetQuery($url);
        return $result;
    }

    /**
     * Список доступных мета-свойств (Properties)
     * 1064 – мета-свойство Клиент
     * @return mixed
     */
    public function getProperties()
    {
        $url = 'http://mfiles.lavi.co.il/REST/structure/properties';
        $result = $this->curlGetQuery($url);
        return $result;
    }

    /**
     * поиск файлов в хранилище по условиям (мета-данным):
     * @return array
     */
    public function getImagesSearch()
    {
        // $this->>getClasses(); чтоб получить ID нужного нам класса
        // $this->>getProperties(); чтоб получить ID нужного нам мета-свойства
        $search = array(
            100 => 19, // 19 - это Класс «Общий документ - Дизайн» (מסמך כללי - עיצוב)
            0 => urlencode('עיצוב'), // Name of title: клиент (עיצוב)
        );
        if(!empty(Yii::$app->request->cookies->getValue('dir_id_mfiles'))){
            // 1064 - это свойство Клиент (לקוח)
            $search[1064] = Yii::$app->request->cookies->getValue('dir_id_mfiles'); // ID текущего клиента
        }
        return $this->search_files_in_dir_by_tags($search);
    }

    /**
     * ищем файлы по Классу и Клиенту
     * именно файлы в директориях
     * @param $tags
     * @return array
     */
    public function search_files_in_dir_by_tags($tags)
    {
        $gt = '';
        $i = 0;
        foreach ($tags as $key=>$val)
        {
            if($val)
                $gt .= '&0' . $i . '_p'.$key.'='.$val;
            $i++;
        }

        $params = '?limit=100&0_qbn=_sjpg_p20_spng_p20_sgif_p20_sjpeg'.$gt; // limit=10000 - пока 100
        $url = 'http://mfiles.lavi.co.il/REST/views/_tempsearch/searchws.aspx' . $params; // var_dump($url);
        //echo "Result M-files <a href='http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/_tempsearch" . $params . "'>here</a>";

        //
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Authentication: ' . $this->getAuthToken(),
            'X-Extensions: MFWA',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Requested-With: XMLHttpRequest',
            'X-Active-Vault: F9930A12-4EE5-473F-A871-CADEE360639E',
        ));
        $output_2 = curl_exec($ch);
        $a = json_decode($output_2, true);
        curl_close($ch);

        if (isset($a['Items']['0'])) {
            // проходим по найденным папкам
            foreach ($a['Items'] as $item) {
                if(!empty($item['ObjectVersion']['Files'])){
                    // если есть файлы – собираем их в массив
                    foreach ($item['ObjectVersion']['Files'] as $file){
                        $file['id1'] = $item['ObjectVersion']['ObjVer']['ID'];
                        $file['id2'] = $file['ID'];
                        $result_items[] = $file;
                    }
                }
            }
            $result = [
                // есть результаты, ошибок нет
                'error' => false,
                'result' => $result_items,
            ];

        } else {
            // ничего не найдено – результат пустой, есть ошибка
            $result = [
                'error' => true,
                'result' => [],
            ];

        }
        return $result;

    }

}