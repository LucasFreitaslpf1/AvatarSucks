<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ContainerLaboratorio;
use PDO;
use yii\data\ArrayDataProvider;

/**
 * ContainerLaboratorioSearch represents the model behind the search form of `app\models\ContainerLaboratorio`.
 */
class ContainerLaboratorioSearch extends ContainerLaboratorio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SIGLA', 'NOME', 'FINALIDADE'], 'safe'],
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

        $sql = "SELECT NOME, SIGLA, TAMANHO, FUNCAO, NUMEROC, NOMEC, CONTAINERLABORATORIO.FINALIDADE FROM CONTAINER
        NATURAL JOIN CONTAINERLABORATORIO";
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
