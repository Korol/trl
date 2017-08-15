<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "client_order_item".
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $order_id
 * @property integer $catalog_item_id
 * @property string $type
 * @property integer $qty
 */
class ClientOrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'order_id', 'catalog_item_id', 'qty'], 'integer'],
            [['type'], 'string'],
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
            'order_id' => 'Order ID',
            'catalog_item_id' => 'Catalog Item ID',
            'type' => 'Type',
            'qty' => 'Qty',
        ];
    }
}
