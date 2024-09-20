<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ContainerDeposito;
use PDO;
use yii\data\ArrayDataProvider;

/**
 * ContainerDepositoSearch represents the model behind the search form of `app\models\ContainerDeposito`.
 */
class ContainerDepositoSearch extends ContainerDeposito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SIGLA', 'NOME', 'TIPO'], 'safe'],
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
        $query = ContainerDeposito::find();

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
        $query->andFilterWhere(['like', 'SIGLA', $this->SIGLA])
            ->andFilterWhere(['like', 'NOME', $this->NOME])
            ->andFilterWhere(['like', 'TIPO', $this->TIPO]);

        return $dataProvider;
    }
}
