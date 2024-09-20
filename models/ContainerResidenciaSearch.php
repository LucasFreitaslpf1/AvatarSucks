<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ContainerResidencia;

/**
 * ContainerResidenciaSearch represents the model behind the search form of `app\models\ContainerResidencia`.
 */
class ContainerResidenciaSearch extends ContainerResidencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SIGLA', 'NOME'], 'safe'],
            [['QUANTIDADE_CAMAS', 'QUANTIDADE_BANHEIROS'], 'integer'],
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
        $query = ContainerResidencia::find();

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
            'QUANTIDADE_CAMAS' => $this->QUANTIDADE_CAMAS,
            'QUANTIDADE_BANHEIROS' => $this->QUANTIDADE_BANHEIROS,
        ]);

        $query->andFilterWhere(['like', 'SIGLA', $this->SIGLA])
            ->andFilterWhere(['like', 'NOME', $this->NOME]);

        return $dataProvider;
    }
}
