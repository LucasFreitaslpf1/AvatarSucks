<?php

namespace app\models;

use Exception;
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

class containerlaboratorio extends Container
{
    public $FINALIDADE;

    public function rules()
    {
        return [
            [['TAMANHO'], 'number'],
            [['FUNCAO'], 'string', 'max' => 255],
            [['SIGLA', 'NOME'], 'required'],
            [['NOME'], 'string', 'max' => 255],
            [['FINALIDADE', 'NOMEC', 'NUMEROC'], 'safe'],
            [['colonia'], 'safe'],
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
            'NOMEC' => 'Nome Colonia',
            'NUMEROC' => 'Numero Colonia',
        ];
    }
    public function save()
    {
        $vars = explode(';', $this->colonia);
        $this->NOMEC = $vars[0];
        $this->NUMEROC = $vars[1];

        $db = Database::instance()->db;
        $db->beginTransaction();

        try {
            $sql = 'INSERT INTO CONTAINER VALUES (:NOME, :SIGLA, :TAMANHO, :FUNCAO, :NUMEROC, :NOMEC)';

            $stmt_container = $db->prepare($sql);

            $stmt_container->bindParam('NOME', $this->NOME);
            $stmt_container->bindParam('SIGLA', $this->SIGLA);
            $stmt_container->bindParam('TAMANHO', $this->TAMANHO);
            $stmt_container->bindParam('FUNCAO', $this->FUNCAO);
            $stmt_container->bindParam('NUMEROC', $this->NUMEROC);
            $stmt_container->bindParam('NOMEC', $this->NOMEC);

            $save1 = $stmt_container->execute();

            $sql2 = 'INSERT INTO CONTAINERLABORATORIO VALUES (:SIGLA, :NOME, :FINALIDADE)';
            $stmt_laboratorio = $db->prepare($sql2);

            $stmt_laboratorio->bindParam('NOME', $this->NOME);
            $stmt_laboratorio->bindParam('SIGLA', $this->SIGLA);
            $stmt_laboratorio->bindParam('FINALIDADE', $this->FINALIDADE);

            $save2 = $stmt_laboratorio->execute();
            if ($save1 && $save2) {
                $db->commit();
                return true;
            }
            return false;
        } catch (Exception $e) {
            Yii::debug($e->getMessage());
            $db->rollBack();
            return false;
        }
    }

    public function update($nome, $sigla)
    {
        $vars = explode(';', $this->colonia);
        $this->NOMEC = $vars[0];
        $this->NUMEROC = $vars[1];

        $db = Database::instance()->db;
        $db->beginTransaction();

        try {
            $sql = 'UPDATE CONTAINER SET NOME = :NOME, SIGLA = :SIGLA, TAMANHO = :TAMANHO, FUNCAO = :FUNCAO, NUMEROC = :NUMEROC, NOMEC = :NOMEC
             WHERE NOME = :CHAVENOME AND SIGLA = :CHAVESIGLA';

            $stmt_container = $db->prepare($sql);

            $stmt_container->bindParam('NOME', $this->NOME);
            $stmt_container->bindParam('SIGLA', $this->SIGLA);
            $stmt_container->bindParam('TAMANHO', $this->TAMANHO);
            $stmt_container->bindParam('FUNCAO', $this->FUNCAO);
            $stmt_container->bindParam('NUMEROC', $this->NUMEROC);
            $stmt_container->bindParam('NOMEC', $this->NOMEC);
            $stmt_container->bindParam('CHAVENOME', $nome);
            $stmt_container->bindParam('CHAVESIGLA', $sigla);

            $save1 = $stmt_container->execute();

            $sql2 = 'UPDATE CONTAINERLABORATORIO SET SIGLA = :SIGLA, NOME = :NOME, FINALIDADE = :FINALIDADE WHERE NOME = :CHAVENOME AND SIGLA = :CHAVESIGLA';
            $stmt_laboratorio = $db->prepare($sql2);

            $stmt_laboratorio->bindParam('NOME', $this->NOME);
            $stmt_laboratorio->bindParam('SIGLA', $this->SIGLA);
            $stmt_laboratorio->bindParam('FINALIDADE', $this->FINALIDADE);
            $stmt_laboratorio->bindParam('CHAVENOME', $nome);
            $stmt_laboratorio->bindParam('CHAVESIGLA', $sigla);

            $save2 = $stmt_laboratorio->execute();

            if ($save1 && $save2) {
                $db->commit();
                return true;
            }
            return false;
        } catch (Exception $e) {
            Yii::debug($e->getMessage());
            $db->rollBack();
            return false;
        }
    }
}
