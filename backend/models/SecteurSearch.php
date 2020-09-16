<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Secteur;

/**
 * Secteur_economiqueSearch represents the model behind the search form of `backend\models\Secteur_economique`.
 */
class SecteurSearch extends Secteur
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_secteur', 'id_secteur'], 'integer'],
            [['libelli'], 'safe'],
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
        $query = Secteur::find();

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
            'id_secteur' => $this->id_secteur,
        ]);

        $query->andFilterWhere(['like', 'libelli', $this->libelli]);

        return $dataProvider;
    }
}
