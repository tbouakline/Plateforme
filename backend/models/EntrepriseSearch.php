<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Entreprise;


/**
 * EntrepriseSearch represents the model behind the search form of `common\models\Entreprise`.
 */
class EntrepriseSearch extends Entreprise
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_entreprise', 'id_activite', 'id_admin'], 'integer'],
            [['branche', 'taille', 'nom_entreprise', 'siege_social','statut_juridique','wilaya','commune'], 'safe'],
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
        $query = Entreprise::find();

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
            'id_entreprise' => $this->id_entreprise,
            'id_activite' => $this->id_activite,
            'id_admin' => $this->id_admin,
        ]);

        $query->andFilterWhere(['like', 'branche', $this->branche])
            ->andFilterWhere(['like', 'statut_juridique', $this->statut_juridique])
            ->andFilterWhere(['like', 'wilaya', $this->wilaya])
            -> andFilterWhere(['like', 'commune', $this->commune])
            ->andFilterWhere(['like', 'taille', $this->taille])
            ->andFilterWhere(['like', 'nom_entreprise', $this->nom_entreprise])
            ->andFilterWhere(['like', 'siege_social', $this->siege_social]);

        return $dataProvider;
    }
}

