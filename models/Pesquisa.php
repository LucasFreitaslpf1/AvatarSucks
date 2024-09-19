<?php

namespace app\models;

use PDO;
use Symfony\Component\VarDumper\Cloner\Data;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Pesquisa extends Model
{
    public $NOME;
    public $NOMELABORATORIO;
    public $SIGLALABORATORIO;
    public $NOMECIENTISTA;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOME', 'NOMELABORATORIO', 'NOMECIENTISTA'], 'required'],
            [['NOME', 'NOMELABORATORIO', 'NOMECIENTISTA'], 'string', 'max' => 255],
            [['SIGLALABORATORIO'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOME' => 'Nome',
            'NOMELABORATORIO' => 'Nome do Laboratório',
            'SIGLALABORATORIO' => 'Sigla do Laboratório',
            'NOMECIENTISTA' => 'Nome do Cientista',
        ];
    }

    public function salvar(): bool
    {
        $vars = explode('-', $this->NOMELABORATORIO);

        $this->SIGLALABORATORIO = $vars[0];
        $this->NOMELABORATORIO = $vars[1];

        $db = Database::instance()->db;

        $sql = 'INSERT INTO PESQUISA VALUES (:NOME, :NOMELABORATORIO, :SIGLALABORATORIO, :NOMECIENTISTA)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam('NOME', $this->NOME);
        $stmt->bindParam('NOMELABORATORIO', $this->NOMELABORATORIO);
        $stmt->bindParam('SIGLALABORATORIO', $this->SIGLALABORATORIO);
        $stmt->bindParam('NOMECIENTISTA', $this->NOMECIENTISTA);

        return $stmt->execute();
    }

    public function atualizar($NOME)
    {

        $db = Database::instance()->db;

        $vars = explode('-', $this->NOMELABORATORIO);

        $this->SIGLALABORATORIO = $vars[0];
        $this->NOMELABORATORIO = $vars[1];

        $stmt = $db->prepare('UPDATE PESQUISA SET NOME = :NOME, NOMELABORATORIO = :NOMELABORATORIO, SIGLALABORATORIO = :SIGLALABORATORIO,
        NOMECIENTISTA = :NOMECIENTISTA WHERE NOME = :CHAVE');

        $stmt->bindParam('NOME', $this->NOME);
        $stmt->bindParam('NOMELABORATORIO', $this->NOMELABORATORIO);
        $stmt->bindParam('SIGLALABORATORIO', $this->SIGLALABORATORIO);
        $stmt->bindParam('NOMECIENTISTA', $this->NOMECIENTISTA);
        $stmt->bindParam('CHAVE', $NOME);

        return $stmt->execute();
    }

    public function delete()
    {
        $db = Database::instance()->db;

        $stmt = $db->prepare('DELETE FROM PESQUISA WHERE NOME = :NOME');
        $stmt->bindParam('NOME', $this->NOME);

        return $stmt->execute();
    }
}
