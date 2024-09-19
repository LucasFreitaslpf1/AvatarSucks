<?php

namespace app\models;

use app\models\Database;
use PDO;
use Yii;
use yii\helpers\ArrayHelper;

class ConsultasHelper
{
    public static function getLaboratorios()
    {
        $db = Database::instance()->db;

        $sql = "SELECT SIGLA, NOME FROM CONTAINERLABORATORIO";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $laboratorios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Yii::debug($laboratorios);
        $laboratorios = ArrayHelper::map($laboratorios, function ($model) {
            return "{$model['SIGLA']}-{$model['NOME']}";
        }, 'NOME');

        return $laboratorios;
    }

    public static function getCientistas()
    {
        $db = Database::instance()->db;

        $sql = "SELECT NOME FROM EMPREGADOCIENTISTA";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $cientistas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cientistas = ArrayHelper::map($cientistas, function ($model) {
            return $model['NOME'];
        }, 'NOME');


        return $cientistas;
    }
}
