<?php

namespace app\models;

use PDO;
use Yii;
use Symfony\Component\VarDumper\Cloner\Data;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\base\Model;



/*
CREATE TABLE container(
    nome varchar2(255),
    sigla varchar2(6),
    tamanho float,
    funcao varchar2(255),
    numeroc int,
    nomec varchar2(80),
    PRIMARY KEY (sigla,nome)
);*/

class Container extends Model
{

    public $NOME;
    public $SIGLA;
    public $TAMANHO;
    public $FUNCAO;
    public $NUMEROC;
    public $NOMEC;

    // SÓ PRA CARREGAR OS VALORES DE COLONIA
    public $colonia;


    public function rules()
    {
        return [
            [['NOME', 'SIGLA'], 'required'],
            [['NOME'], 'string', 'max' => 255],
            [['SIGLA'], 'string', 'max' => 6],
            [['TAMANHO'], 'number'],
            [['FUNCAO'], 'string', 'max' => 255],
            [['NUMEROC'], 'integer'],
            [['NOMEC'], 'string', 'max' => 80],
            [['colonia'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'NOME' => 'Nome',
            'SIGLA' => 'Sigla',
            'TAMANHO' => 'Tamanho',
            'FUNCAO' => 'Função',
            'NUMEROC' => 'Número',
            'NOMEC' => 'Nome Colônia',
        ];
    }
}
