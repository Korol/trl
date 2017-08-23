<?php

namespace frontend\models;

use Yii;
use frontend\models\CatalogItemOld2;

/**
 * This is the model class for table "client_catalog_item".
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $catalog_item_sku
 */
class ClientCatalogItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_catalog_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['catalog_item_sku'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'catalog_item_sku' => 'Catalog Item SKU',
        ];
    }

    public function getCatalogItem()
    {
        return $this->hasOne(CatalogItemOld2::className(), ['sku' => 'catalog_item_sku']);
    }
}
