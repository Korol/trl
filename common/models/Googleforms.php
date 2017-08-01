<?php

namespace common\models;

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
            [['name', 'google_id', 'google_id_editmode', 'comment'], 'required'],
            [['comment',
                'mfiles_meta_class_id',
                'mfiles_meta_dropdwn_001_id',
                'mfiles_meta_dropdwn_002_id',
                'internal_message',
                'internal_emails',

            ], 'safe'],
            [['name', 'google_id'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 250],
            [['name', 'comment', 'google_id'], 'filter', 'filter' => 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Form Name',
            'google_id' => 'Form URL VIEW mode (https://docs.google.com/forms/d/e/1FAIpQLS...oWQ/viewform)',
            'google_id_editmode' => 'Form URL EDIT mode (https://docs.google.com/forms/d/1pQQOz_WfD0...e230Po/edit)',
            'comment' => 'Form Client Field ID (entry.XXXXXXXXX in View mode GForm)',

            'mfiles_meta_class_id' => 'Field - Class',
            'mfiles_meta_dropdwn_001_id' => 'Field - סוג מסמך',
            'mfiles_meta_dropdwn_002_id' => 'Field - סוג מסמך משנה',


            'internal_message' => 'Internal message',
            'internak_emails' => 'List E-mails for Internal message (; semicoloned)',

        ];
    }
}


