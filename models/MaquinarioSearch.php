<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Maquinario;
use PDO;
use yii\data\ArrayDataProvider;

/**
 * MaquinarioSearch represents the model behind the search form of `app\models\Maquinario`.
 */
class MaquinarioSearch extends Maquinario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOME', 'TIPO'], 'safe'],
            [['POTENCIA', 'PESO', 'CAPACIDADE', 'LATITUDEJ', 'LONGITUDEJ'], 'number'],
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

        $sql = "SELECT NOME, TIPO, POTENCIA, PESO, CAPACIDADE, LATITUDEJ, LONGITUDEJ FROM MAQUINARIO";
        $params = [];

        
        if (!empty($this->NOME)) {
            $sql .= " WHERE NOME LIKE :NOME";
            $params[':NOME'] = "%{$this->NOME}%";
        }
        if (!empty($this->TIPO)) {
            if (empty($params)) {
                $sql .= " WHERE TIPO LIKE :TIPO";
            } else {
                $sql .= " AND TIPO LIKE :TIPO";
            }
            $params[':TIPO'] = "%{$this->TIPO}%";
        }
        if (!empty($this->POTENCIA)) {
            if (empty($params)) {
                $sql .= " WHERE POTENCIA = :POTENCIA";
            } else {
                $sql .= " AND POTENCIA = :POTENCIA";
            }
            $params[':POTENCIA'] = $this->POTENCIA;
        }
        if (!empty($this->PESO)) {
            if (empty($params)) {
                $sql .= " WHERE PESO = :PES";
            } else {
                $sql .= " AND PESO = :PESO";
            }
            $params[':PESO'] = $this->PESO;
        }
        if (!empty($this->CAPACIDADE)) {
            if (empty($params)) {
                $sql .= " WHERE CAPACIDADE = :CAPACIDADE";
            } else {
                $sql .= " AND CAPACIDADE = :CAPACIDADE";
            }
            $params[':CAPACIDADE'] = $this->CAPACIDADE;
        }
        if (!empty($this->LATITUDEJ)) {
            if (empty($params)) {
                $sql .= " WHERE LATITUDEJ = :LATITUDEJ";
            } else {
                $sql .= " AND LATITUDEJ = :LATITUDEJ";
            }
            $params[':LATITUDEJ'] = $this->LATITUDEJ;
        }
        if (!empty($this->LONGITUDEJ)) {
            if (empty($params)) {
                $sql .= " WHERE LONGITUDEJ = :LONGITUDEJ";
            } else {
                $sql .= " AND LONGITUDEJ = :LONGITUDEJ";
            }
            $params[':LONGITUDEJ'] = $this->LONGITUDEJ;
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
