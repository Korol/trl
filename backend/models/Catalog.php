<?php

namespace backend\models;

use Yii;
use backend\models\CatalogItemOld;

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
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function getCatalogItem()
    {
        return $this->hasMany(CatalogItemOld::className(), ['catalog_id' => 'id']);
    }
}
