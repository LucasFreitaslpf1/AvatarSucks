<?php

namespace app\models;

use PDO;
use Yii;
use Symfony\Component\VarDumper\Cloner\Data;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * CREATE TABLE containerdeposito(
    sigla varchar2(6),
    nome varchar2(255),
    tipo varchar2(255),
    PRIMARY KEY (sigla, nome)
);
 */
class ContainerDeposito extends ActiveRecord 
{
    public static function tableName()
    {
        return 'CONTAINERDEPOSITO';
    }

    public function rules()
    {
        return [
            [['SIGLA', 'NOME'], 'required'],
            [['NOME'], 'string', 'max' => 255],
            [['SIGLA'], 'string', 'max' => 6],
            [['TIPO'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'NOME' => 'Nome',
            'SIGLA' => 'Sigla',
            'TIPO' => 'Tipo',
        ];
    }
}