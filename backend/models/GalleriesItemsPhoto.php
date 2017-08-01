<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "my_galleries_items_photo".
 *
 * @property integer $id_item
 * @property integer $gallery_id
 * @property string $name_item
 * @property integer $file_id
 */
class GalleriesItemsPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_galleries_items_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_id', 'name_item', 'file_id'], 'required'],
            [['gallery_id', 'file_id'], 'integer'],
            [['name_item'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_item' => 'Id Item',
            'gallery_id' => 'Gallery ID',
            'name_item' => 'Name Item',
            'file_id' => 'File ID',
        ];
    }
}
