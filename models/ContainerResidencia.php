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
 * CREATE TABLE containerresidencia(
    sigla varchar2(6),
    nome varchar2(255),
    quantidade_camas int,
    quantidade_banheiros int,
    PRIMARY KEY(sigla, nome)
);
 */
class ContainerResidencia extends Container
{
    public $QUANTIDADE_CAMAS;
    public $QUANTIDADE_BANHEIROS;
    public function rules()
    {
        return [
            [['TAMANHO'], 'number'],
            [['FUNCAO'], 'string', 'max' => 255],
            [['SIGLA', 'NOME'], 'required'],
            [['NOMEC', 'NUMEROC'], 'safe'],
            [['colonia'], 'safe'],
            [['NOME'], 'string', 'max' => 255],
            [['SIGLA'], 'string', 'max' => 6],
            [['TIPO'], 'string', 'max' => 255],
            [['QUANTIDADE_CAMAS', 'QUANTIDADE_BANHEIROS'], 'safe'],
            [['QUANTIDADE_CAMAS', 'QUANTIDADE_BANHEIROS'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'NOME' => 'Nome',
            'SIGLA' => 'Sigla',
            'QUANTIDADE_CAMAS' => 'Quantidade de Camas',
            'QUANTIDADE_BANHEIROS' => 'Quantidade de Banheiros',
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

            $sql2 = 'INSERT INTO CONTAINERRESIDENCIA VALUES (:SIGLA, :NOME, :QUANTIDADE_CAMAS, :QUANTIDADE_BANHEIROS)';
            $stmt_deposito = $db->prepare($sql2);

            $stmt_deposito->bindParam('NOME', $this->NOME);
            $stmt_deposito->bindParam('SIGLA', $this->SIGLA);
            $stmt_deposito->bindParam('QUANTIDADE_CAMAS', $this->QUANTIDADE_CAMAS);
            $stmt_deposito->bindParam('QUANTIDADE_BANHEIROS', $this->QUANTIDADE_BANHEIROS);

            $save2 = $stmt_deposito->execute();
            if ($save1 && $save2) {
                $db->commit();
                return true;
            }
            $db->rollback();
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

            $sql2 = 'UPDATE CONTAINERRESIDENCIA SET SIGLA = :SIGLA, NOME = :NOME, QUANTIDADE_CAMAS = :QUANTIDADE_CAMAS, QUANTIDADE_BANHEIROS = :QUANTIDADE_BANHEIROS WHERE NOME = :CHAVENOME AND SIGLA = :CHAVESIGLA';
            $stmt_deposito = $db->prepare($sql2);

            $stmt_deposito->bindParam('NOME', $this->NOME);
            $stmt_deposito->bindParam('SIGLA', $this->SIGLA);
            $stmt_deposito->bindParam('QUANTIDADE_CAMAS', $this->QUANTIDADE_CAMAS);
            $stmt_deposito->bindParam('QUANTIDADE_BANHEIROS', $this->QUANTIDADE_BANHEIROS);
            $stmt_deposito->bindParam('CHAVENOME', $nome);
            $stmt_deposito->bindParam('CHAVESIGLA', $sigla);

            $save2 = $stmt_deposito->execute();

            if ($save1 && $save2) {
                $db->commit();
                return true;
            }
            $db->rollback();
            return false;
        } catch (Exception $e) {
            Yii::debug($e->getMessage());
            $db->rollBack();
            return false;
        }
    }

    public function delete($NOME, $SIGLA)
    {
        $db = Database::instance()->db;
        $db->beginTransaction();

        try {

            $stmt = $db->prepare('DELETE FROM CONTAINERRESIDENCIA WHERE NOME = :NOME AND SIGLA = :SIGLA');
            $stmt->bindParam('NOME', $this->NOME);
            $stmt->bindParam('SIGLA', $this->SIGLA);

            $del1 = $stmt->execute();

            $stmt1 = $db->prepare('DELETE FROM CONTAINER WHERE NOME = :NOME AND SIGLA = :SIGLA');
            $stmt1->bindParam('NOME', $this->NOME);
            $stmt1->bindParam('SIGLA', $this->SIGLA);

            $del2 = $stmt1->execute();

            if ($del1 && $del2) {
                $db->commit();
                return true;
            }

            $db->rollback();
            return false;
        } catch (Exception $e) {
            $db->rollBack();
            return false;
        }
    }
}
