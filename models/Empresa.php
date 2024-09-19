<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Empresa extends Model
{
    public $REGISTRO;
    public $NOME;
    public $SIGLA;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['REGISTRO'], 'required'],
            [['REGISTRO'], 'string', 'max' => 255],
            [['NOME'], 'string', 'max' => 60],
            [['SIGLA'], 'string', 'max' => 6],
            [['REGISTRO'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
        ];
    }

    public function salvar(): bool
    {
        $db = Database::instance()->db;

        $stmt = $db->prepare('INSERT INTO EMPRESA VALUES (:REGISTRO, :NOME, :SIGLA)');

        $stmt->bindParam('REGISTRO', $this->REGISTRO);
        $stmt->bindParam('NOME', $this->NOME);
        $stmt->bindParam('SIGLA', $this->SIGLA);

        return $stmt->execute();
    }

    public function atualizar($REGISTRO)
    {
        $db = Database::instance()->db;

        $stmt = $db->prepare('UPDATE EMPRESA SET REGISTRO = :REGISTRO, NOME = :NOME, SIGLA = :SIGLA
        WHERE REGISTRO = :CHAVE');

        $stmt->bindParam('REGISTRO', $this->REGISTRO);
        $stmt->bindParam('NOME', $this->NOME);
        $stmt->bindParam('SIGLA', $this->SIGLA);
        $stmt->bindParam('CHAVE', $REGISTRO);


        return $stmt->execute();
    }

    public function delete()
    {
        $db = Database::instance()->db;

        $stmt = $db->prepare('DELETE FROM EMPRESA WHERE REGISTRO = :REGISTRO');
        $stmt->bindParam('REGISTRO', $this->REGISTRO);

        return $stmt->execute();
    }
}
