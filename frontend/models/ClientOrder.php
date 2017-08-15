<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "client_order".
 *
 * @property integer $id
 * @property integer $client_id
 * @property string $created
 * @property string $updated
 */
class ClientOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['created', 'updated'], 'safe'],
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
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
