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

    // не все документы а только хранлище клиентов
    //mfiles.lavi.co.il не открываюся в офисе клиента
   // $url = 'http://mfiles.lavi.co.il/Default.aspx?#F9930A12-4EE5-473F-A871-CADEE360639E/object/529478F2-7E26-4A65-BA4F-808FBE6ED1F1/latest';
    ?>
    <?= Yii::t('common', 'Result will be stored here in') ?> <a target="_blank"
                                                                href="<?= $url ?>">M-Files</a>
</p>

