<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $desc
 * @property string $type
 * @property string $section
 * @property string $key
 * @property string $value
 * @property integer $active
 * @property string $created
 * @property string $modified
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'required'],
            [['desc', 'value'], 'string'],
            [['active'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['type', 'section', 'key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desc' => 'Описание',
            'type' => 'Type',
            'section' => 'Раздел',
            'key' => 'Имя',
            'value' => 'Значение',
            'active' => 'Active',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
