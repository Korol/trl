<?php

namespace frontend\components;

//use app\models\MenuPanel;
//use app\models\Zuser;
//use app\models\Vwrole;
//use app\assets\AppAsset;


use common\models\Googleforms;
use common\models\GalleriesPhotomarkup;
use Yii;
use yii\db\Query;

class Menuhelper
{

    public static function getGForm_SecondMenu()
    {
        $gforms = Googleforms::find()->asArray()->all();
        foreach ($gforms as $gf)
            $a[] = ['label' => $gf['name'], 'url' => ['/googleforms/view?id=' . $gf['id']]];
        return $a;
    }

    public static function getGForm_SecondMenu_html()
    {
        $a = '';
        $gforms = Googleforms::find()->asArray()->all();
        foreach ($gforms as $gf)
            $a .= '<li><a href="/googleforms/view?id=' . $gf['id'] . '" tabindex="-1">' . $gf['name'] . '</a></li>';
        return $a;
    }

    public static function getPhotoMark_SecondMenu()
    {
        $gforms = GalleriesPhotomarkup::find()->asArray()->all();
        foreach ($gforms as $gf)
            $a[] = ['label' => $gf['name_gallery'], 'url' => ['/site/marking-photo-list-2?id=' . $gf['id_gallery']]];
        return $a;
    }

    public static function getPhotoMark_SecondMenu_html()
    {
        $a = '';
        $gforms = GalleriesPhotomarkup::find()->asArray()->all();
        foreach ($gforms as $gf)
            $a .= '<li><a href="/site/marking-photo-list-2?id=' . $gf['id_gallery'] . '" tabindex="-1">' . $gf['name_gallery'] . '</a></li>';
        return $a;
    }


}