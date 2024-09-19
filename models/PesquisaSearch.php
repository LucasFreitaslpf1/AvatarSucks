<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pesquisa;
use PDO;
use yii\data\ArrayDataProvider;

/**
 * PesquisaSearch represents the model behind the search form of `app\models\Pesquisa`.
 */
class PesquisaSearch extends Pesquisa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOME', 'NOMELABORATORIO', 'SIGLALABORATORIO', 'NOMECIENTISTA'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $this->load($params);

        $db = Database::instance()->db;

        $sql = "SELECT NOME, NOMELABORATORIO, SIGLALABORATORIO, NOMECIENTISTA FROM PESQUISA";
        $params = [];

        if (!empty($this->NOME)) {
            $sql .= " WHERE NOME LIKE :NOME";
            $params[':NOME'] = "%{$this->NOME}%";
        }
        if (!empty($this->NOMELABORATORIO)) {
            if (empty($params)) {
                $sql .= " WHERE NOMELABORATORIO LIKE :NOMELABORATORIO";
            } else {
                $sql .= " AND NOMELABORATORIO LIKE :NOMELABORATORIO";
            }
            $params[':NOMELABORATORIO'] = "%{$this->NOMELABORATORIO}%";
        }
        if (!empty($this->SIGLALABORATORIO)) {
            if (empty($params)) {
                $sql .= " WHERE SIGLALABORATORIO LIKE :SIGLALABORATORIO";
            } else {
                $sql .= " AND SIGLALABORATORIO LIKE :SIGLALABORATORIO";
            }
            $params[':SIGLALABORATORIO'] = "%{$this->SIGLALABORATORIO}%";
        }
        if (!empty($this->NOMECIENTISTA)) {
            if (empty($params)) {
                $sql .= " WHERE NOMECIENTISTA LIKE :NOMECIENTISTA";
            } else {
                $sql .= " AND NOMECIENTISTA LIKE :NOMECIENTISTA";
            }
            $params[':NOMECIENTISTA'] = "%{$this->NOMECIENTISTA}%";
        }

        $stmt = $db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $value);
        }

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
