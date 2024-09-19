<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empresa;
use PDO;
use Yii;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;

/**
 * EmpresaSearch represents the model behind the search form of `app\models\Empresa`.
 */
class EmpresaSearch extends Empresa
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['REGISTRO', 'NOME', 'SIGLA'], 'safe'],
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

        $sql = "SELECT NOME, REGISTRO, SIGLA FROM EMPRESA";
        $params = [];

        if (!empty($this->REGISTRO)) {
            $sql .= " WHERE REGISTRO LIKE :REGISTRO";
            $params[':REGISTRO'] = "%{$this->REGISTRO}%";
        }
        if (!empty($this->NOME)) {
            if (empty($params)) {
                $sql .= " WHERE NOME LIKE :NOME";
            } else {
                $sql .= " AND NOME LIKE :NOME";
            }
            $params[':NOME'] = "%{$this->NOME}%";
        }
        if (!empty($this->SIGLA)) {
            if (empty($params)) {
                $sql .= " WHERE SIGLA LIKE :SIGLA";
            } else {
                $sql .= " AND SIGLA LIKE :SIGLA";
            }
            $params[':SIGLA'] = "%{$this->SIGLA}%";
        }

        $stmt = $db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $value);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
        ]);

        return $dataProvider;
    }
}
