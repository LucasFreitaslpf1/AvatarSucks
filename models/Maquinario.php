<?php

namespace app\models;

use PDO;
use Yii;
use Symfony\Component\VarDumper\Cloner\Data;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\base\Model;


/**
 * CREATE TABLE maquinario(
    nome varchar2(255),
    tipo varchar2(60),
    potencia float,
    peso float,
    capacidade float,
    latitudej float,
    longitudej float,
    PRIMARY KEY(nome, tipo)
);
 */

class Maquinario extends Model
{

    public $NOME;
    public $TIPO;
    public $POTENCIA;
    public $PESO;
    public $CAPACIDADE;
    public $LATITUDEJ;
    public $LONGITUDEJ;

    // Usado apenas para pegar do form
    public $latitude_longitude;

    public function rules()
    {

        return [
            [['NOME', 'TIPO'], 'required'],
            [['NOME'], 'string', 'max' => 255],
            [['TIPO'], 'string', 'max' => 60],
            [['POTENCIA', 'PESO', 'CAPACIDADE'], 'number'],
            [['LATITUDEJ', 'LONGITUDEJ'], 'number'],
            [['latitude_longitude'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'NOME' => 'Nome',
            'TIPO' => 'Tipo',
            'POTENCIA' => 'Potência',
            'PESO' => 'Peso',
            'CAPACIDADE' => 'Capacidade',
            'LATITUDEJ' => 'Latitude Jazida',
            'LONGITUDEJ' => 'Longitude Jazida',
        ];
    }


    public function save(): bool
    {
        $vars = explode(';', $this->latitude_longitude);

        $this->LONGITUDEJ = $vars[0];
        $this->LATITUDEJ = $vars[1];

        $db = Database::instance()->db;

        $sql = 'INSERT INTO MAQUINARIO VALUES (:NOME, :TIPO, :POTENCIA, :PESO, :CAPACIDADE, :LATITUDEJ, :LONGITUDEJ)';
        $stmt = $db->prepare($sql);

        // Associa os parâmetros
        $stmt->bindParam(':NOME', $this->NOME);
        $stmt->bindParam(':TIPO', $this->TIPO);
        $stmt->bindParam(':POTENCIA', $this->POTENCIA);
        $stmt->bindParam(':PESO', $this->PESO);
        $stmt->bindParam(':CAPACIDADE', $this->CAPACIDADE);
        $stmt->bindParam(':LATITUDEJ', $this->LATITUDEJ);
        $stmt->bindParam(':LONGITUDEJ', $this->LONGITUDEJ);

        return $stmt->execute();
    }

    public function update($nome, $tipo)
    {

        $db = Database::instance()->db;

        $vars = explode(';', $this->latitude_longitude);

        $this->LONGITUDEJ = $vars[0];
        $this->LATITUDEJ = $vars[1];


        $stmt = $db->prepare("UPDATE MAQUINARIO SET NOME = :NOME, TIPO = :TIPO, POTENCIA = :POTENCIA, PESO = :PESO, CAPACIDADE = :CAPACIDADE,
        LATITUDEJ = :LATITUDEJ, LONGITUDEJ = :LONGITUDEJ WHERE NOME = :CHAVENOME AND TIPO = :CHAVETIPO");


        $stmt->bindParam(':NOME',  $this->NOME);
        $stmt->bindParam(':TIPO', $this->TIPO);
        $stmt->bindParam(':POTENCIA', $this->POTENCIA);
        $stmt->bindParam(':PESO', $this->PESO);
        $stmt->bindParam(':CAPACIDADE', $this->CAPACIDADE);
        $stmt->bindParam(':LATITUDEJ', $this->LATITUDEJ);
        $stmt->bindParam(':LONGITUDEJ', $this->LONGITUDEJ);
        $stmt->bindParam(':CHAVENOME', $nome);
        $stmt->bindParam(':CHAVETIPO', $tipo);

        return $stmt->execute();
    }

    public function delete()
    {

        $db = Database::instance()->db;

        $stmt = $db->prepare('DELETE FROM MAQUINARIO WHERE NOME = :NOME AND TIPO = :TIPO');


        $stmt->bindParam('NOME', $this->NOME);
        $stmt->bindParam('TIPO', $this->TIPO);


        return $stmt->execute();
    }
}
