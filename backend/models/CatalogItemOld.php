<?php

namespace backend\models;

use Yii;
use backend\models\Catalog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalog_item".
 *
 * @property integer $id
 * @property integer $catalog_id
 * @property string $title
 * @property string $description
 * @property integer $active
 */
class CatalogItemOld extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_item';
    }

    public function behaviors()
    {
        return [
            'fileBehavior' => [
                'class' => \nemmo\attachments\behaviors\FileBehavior::className()
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'active'], 'integer'],
            [['description'], 'string'],
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
            'catalog_id' => Yii::t('app', 'Catalog'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
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
