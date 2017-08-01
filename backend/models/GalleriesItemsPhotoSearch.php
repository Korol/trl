<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GalleriesItemsPhoto;

/**
 * GalleriesItemsPhotoSearch represents the model behind the search form about `app\models\GalleriesItemsPhoto`.
 */
class GalleriesItemsPhotoSearch extends GalleriesItemsPhoto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_item', 'gallery_id', 'file_id'], 'integer'],
            [['name_item'], 'safe'],
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
        $query = GalleriesItemsPhoto::find();

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
            'id_item' => $this->id_item,
            'gallery_id' => $this->gallery_id,
            'file_id' => $this->file_id,
        ]);

        $query->andFilterWhere(['like', 'name_item', $this->name_item]);

        return $dataProvider;
    }
}
