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
    public static function getLatitude()
    {
        $db = Database::instance()->db;

        $sql = "SELECT LATITUDE FROM JAZIDA"; 

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $latitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mapeia as jazidas para retornar os nomes com latitudes e longitudes
        $latitudes = ArrayHelper::map($latitudes, function ($model) {
            return $model['LATITUDE'];
        }, 'LATITUDE');

        return $latitudes;
    }
    public static function getLongitude()
    {
        $db = Database::instance()->db;

        $sql = "SELECT LONGITUDE FROM JAZIDA"; 

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $longitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mapeia as jazidas para retornar os nomes com latitudes e longitudes
        $longitudes = ArrayHelper::map($longitudes, function ($model) {
            return $model['LONGITUDE'];
        }, 'LONGITUDE');

        return $longitudes;
    }

}
