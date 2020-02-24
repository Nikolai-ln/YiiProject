<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Building;

/**
 * BuildingSearch represents the model behind the search form of `app\models\Building`.
 */
class BuildingSearch extends Building
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['building_id'], 'integer'],
            [['name', 'city_id'], 'safe'], //we add city_id here to search by letters
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Building::find();
        $query->joinWith(['city']);
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
            'building_id' => $this->building_id,
            //'city_id' => $this->city_id, //we comment this
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'city.name', $this->city_id]);

        return $dataProvider;
    }
}
