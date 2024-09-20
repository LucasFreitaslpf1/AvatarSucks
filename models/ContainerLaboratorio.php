<?php

namespace app\models;

use PDO;
use Yii;
use Symfony\Component\VarDumper\Cloner\Data;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * CREATE TABLE containerlaboratorio(
    sigla varchar2(6),
    nome varchar2(255),
    finalidade varchar2(255),
    PRIMARY KEY (sigla,nome)
);
 */

class containerlaboratorio extends ActiveRecord
{
    public static function tableName()
    {
        return 'CONTAINERLABORATORIO';
    }

    public function rules()
    {
        return [
            [['SIGLA', 'NOME'], 'required'],
            [['NOME'], 'string', 'max' => 255],
            [['SIGLA'], 'string', 'max' => 6],
            [['FINALIDADE'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'NOME' => 'Nome',
            'SIGLA' => 'Sigla',
            'FINALIDADE' => 'Finalidade',
        ];
    }
    public function saveContainerLaboratorio()
    {
        $transaction = Yii::$app->db->beginTransaction(); // Iniciar transação
        try {
            // Primeiro, salvar no modelo Container
            $container = new Container();  // Certifique-se de ter o modelo Container
            $container->SIGLA = $this->SIGLA;
            $container->NOME = $this->NOME;
            // Definir outros atributos de Container se houver
            if (!$container->save()) {
                // Falha ao salvar Container
                $transaction->rollBack();
                return false;
            }

            // Agora salvar ContainerLaboratorio
            if (!$this->save()) {
                // Falha ao salvar ContainerLaboratorio
                $transaction->rollBack();
                return false;
            }

            $transaction->commit(); // Confirma a transação
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack(); // Reverte em caso de erro
            throw $e;
        }
    }



}
