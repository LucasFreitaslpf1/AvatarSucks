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

class Container extends ActiveRecord{

    public $NOME;
    public $SIGLA;
    public $TAMANHO;
    public $FUNCAO;
    public $NUMEROC;
    public $NOMEC;

    public static function tableName()
    {
        return 'CONTAINER';
    }

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

    public function saveContainer($containerData, $specificData)
    {
        $this->setAttributes($containerData);

        if ($this->save()) {
            foreach ($specificData as $data) {
                $specificModel = new SpecificContainer(); // Use o modelo específico correspondente
                $specificModel->setAttributes($data);
                $specificModel->SIGLA = $this->SIGLA; // Associar a sigla
                $specificModel->NOME = $this->NOME;   // Associar o nome

                if (!$specificModel->save()) {
                    return false; // Se falhar, retornar false
                }
            }
            return true; // Se tudo foi salvo com sucesso
        }

        return false; // Se o Container não foi salvo
    }





}