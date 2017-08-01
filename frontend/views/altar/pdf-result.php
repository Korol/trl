<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo 'Specifivation was generated and sent to your email.';

?>


<p>
    <?php
    // ищем только папки созданные киентом - я такие так и не научился создавать даже в ручну.!!!
    $params = '?limit=500&0_o=102&00_p0^=' . $client_name;
    // не все документы а только хранлище клиентов
    //mfiles.lavi.co.il не открываюся в офисе клиента
    $url = 'http://mfiles.lavi.co.il/Default.aspx#F9930A12-4EE5-473F-A871-CADEE360639E/views/_tempsearch' . $params;
    ?>
    <?= Yii::t('common', 'Result will be stored here in') ?> <a target="_blank"
                                                                href="<?= $url ?>">M-Files</a>
</p>

