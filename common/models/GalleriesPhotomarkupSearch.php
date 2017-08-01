<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GalleriesPhotomarkup;

/**
 * GalleriesPhotomarkupSearch represents the model behind the search form about `app\models\GalleriesPhotomarkup`.
 */
class GalleriesPhotomarkupSearch extends GalleriesPhotomarkup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_gallery', 'commwnt_gallery'], 'integer'],
            [['name_gallery'], 'safe'],
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
        $query = GalleriesPhotomarkup::find();

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
            'id_gallery' => $this->id_gallery,
            'commwnt_gallery' => $this->commwnt_gallery,
        ]);

        $query->andFilterWhere(['like', 'name_gallery', $this->name_gallery]);

        return $dataProvider;
    }
}
