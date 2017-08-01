<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "my_galleries_photomarkup".
 *
 * @property integer $id_gallery
 * @property string $name_gallery
 * @property integer $commwnt_gallery
 */
class GalleriesPhotomarkup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_galleries_photomarkup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_gallery'], 'required'],
            [['name_gallery', 'commwnt_gallery'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_gallery' => 'Id Gallery',
            'name_gallery' => 'Name Gallery',
            'commwnt_gallery' => 'Comment',
        ];
    }
}
