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
        $this->load($params);

        $db = Database::instance()->db;

        $sql = "SELECT NOME, SIGLA, TAMANHO, FUNCAO, NUMEROC, NOMEC, CONTAINERDEPOSITO.TIPO FROM CONTAINER
        NATURAL JOIN CONTAINERDEPOSITO";
        $params = [];

        $stmt = $db->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $dataProvider;
    }
}
