<?php

namespace backend\models;

use Yii;
use backend\models\Catalog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalog_item_import".
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
            'comment' => 'Comment'
        ];
    }

    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }

    public static function getCatalogList()
    {
        $list = Catalog::find()->orderBy('title ASC')->all();
        if(!empty($list)){
            return ArrayHelper::map($list, 'id', 'title');
        }
        else{
            return [];
        }
    }
}
