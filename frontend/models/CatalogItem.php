<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "catalog_item".
 *
 * @property integer $id
 * @property integer $catalog_id
 * @property string $sku
 * @property string $name
 * @property string $image
 * @property string $image_text
 * @property string $favorite
 * @property integer $num_rows
 * @property integer $num_seats
 * @property integer $total_num_seats
 * @property string $specification
 * @property string $placement
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
            [['num_rows', 'num_seats', 'total_num_seats', 'catalog_id'], 'integer'],
            [['comment'], 'string'],
            [['sku', 'name', 'image', 'image_text', 'favorite', 'specification', 'placement'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'catalog_id' => Yii::t('app', 'Catalog ID'),
            'sku' => Yii::t('app', 'Sku'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'),
            'image_text' => Yii::t('app', 'Image Text'),
            'favorite' => Yii::t('app', 'Favorite'),
            'num_rows' => Yii::t('app', 'Num Rows'),
            'num_seats' => Yii::t('app', 'Num Seats'),
            'total_num_seats' => Yii::t('app', 'Total Num Seats'),
            'specification' => Yii::t('app', 'Specification'),
            'placement' => Yii::t('app', 'Placement'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }
}
