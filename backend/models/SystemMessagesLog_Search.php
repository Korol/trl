<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SystemMessagesLog;

/**
 * SystemMessagesLog_Search represents the model behind the search form about `app\models\SystemMessagesLog`.
 */
class SystemMessagesLog_Search extends SystemMessagesLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_message', 'importance_message'], 'integer'],
            [['date_message', 'from_message', 'subj_message', 'body_message'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SystemMessagesLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_message' => $this->id_message,
            'date_message' => $this->date_message,
            'importance_message' => $this->importance_message,
        ]);

        $query->andFilterWhere(['like', 'from_message', $this->from_message])
            ->andFilterWhere(['like', 'subj_message', $this->subj_message])
            ->andFilterWhere(['like', 'body_message', $this->body_message]);

        return $dataProvider;
    }
}
