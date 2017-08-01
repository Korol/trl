<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "my_system_messages_log".
 *
 * @property integer $id_message
 * @property string $date_message
 * @property integer $importance_message
 * @property string $from_message
 * @property string $subj_message
 * @property string $body_message
 */
class SystemMessagesLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_system_messages_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_message'], 'required'],
            [['id_message', 'importance_message'], 'integer'],
            [['date_message'], 'safe'],
            [['body_message'], 'string'],
            [['from_message'], 'string', 'max' => 245],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_message' => 'Id Message',
            'date_message' => 'Date Message',
            'importance_message' => 'Важность',
            'from_message' => 'From Message',
            'subj_message' => 'Subj Message',
            'body_message' => 'Дамп TXT/HTML',
        ];
    }
}
