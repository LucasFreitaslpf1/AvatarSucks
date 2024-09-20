<?php

namespace app\models;

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
class ContainerResidencia extends ActiveRecord 
{
    public static function tableName()
    {
        return 'CONTAINERRESIDENCIA';
    }

    public function rules()
    {
        return [
            [['SIGLA', 'NOME'], 'required'],
            [['NOME'], 'string', 'max' => 255],
            [['SIGLA'], 'string', 'max' => 6],
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
        ];
    }


}