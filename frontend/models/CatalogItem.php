<?php

namespace frontend\models;

use Yii;
use frontend\models\Catalog;

/**
 * This is the model class for table "catalog_item".
 *
 * @property integer $id
 * @property integer $catalog_id
 * @property string $name
 * @property string $image
 * @property string $sku
 * @property string $specification
 * @property string $placement
 * @property integer $places_num
 * @property string $comment
 */
class CatalogItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'places_num'], 'integer'],
            [['specification', 'comment'], 'string'],
            [['name', 'image', 'sku', 'placement'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catalog_id' => 'Catalog ID',
            'name' => 'Name',
            'image' => 'Image',
            'sku' => 'Sku',
            'specification' => 'Specification',
            'placement' => 'Placement',
            'places_num' => 'Places Num',
            'comment' => 'Comment',
        ];
    }

    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }
}
