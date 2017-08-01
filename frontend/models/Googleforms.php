<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "my_googleforms".
 *
 * @property integer $id
 * @property string $name
 * @property string $google_id
 * @property string $comment
 */
class Googleforms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_googleforms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'google_id', 'comment'], 'required'],
            [['name', 'google_id'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'google_id' => 'Google ID',
            'comment' => 'Comment',
        ];
    }
}
