<?php

namespace frontend\models;

use Yii;
use frontend\models\CatalogItemOld2;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $active
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['active'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'active' => 'Active',
        ];
    }

    public function getCatalogItem()
    {
        return $this->hasMany(CatalogItemOld2::className(), ['catalog_id' => 'id']);
    }
}
