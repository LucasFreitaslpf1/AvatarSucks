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

    public static function getJazidas()
    {
        $db = Database::instance()->db;

        $sql = "SELECT LATITUDE, LONGITUDE FROM JAZIDA";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $jazidas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jazidas = ArrayHelper::map($jazidas, function ($model) {
            return "{$model['LONGITUDE']};{$model['LATITUDE']}";
        }, function ($model) {
            return "{$model['LONGITUDE']};{$model['LATITUDE']}";
        });

        return $jazidas;
    }

    public static function getColonias()
    {
        $db = Database::instance()->db;

        $sql = "SELECT NOME, NUMERO FROM COLONIA";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $colonias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $colonias = ArrayHelper::map($colonias, function ($model) {
            return "{$model['NOME']};{$model['NUMERO']}";
        }, function ($model) {
            return "{$model['NUMERO']} - {$model['NOME']}";
        });

        return $colonias;
    }

    public static function getHumanoColonia($NOMEC, $NUMEROC)
    {
        $db = Database::instance()->db;

        $sql = "SELECT NOME, PAPEL FROM EMPREGADO WHERE NOMEC = :NOMEC AND NUMEROC = :NUMEROC";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('NOMEC', $NOMEC);
        $stmt->bindParam('NUMEROC', $NUMEROC);
        $stmt->execute();

        $empregados = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return $empregados;
    }

    public static function getEquipamentosColonia($NOMEC, $NUMEROC)
    {
        $db = Database::instance()->db;

        $sql = "SELECT e.NOME FROM EQUIPAMENTO e INNER JOIN PESQUISAEQUIPAMENTO p ON e.NOME = p.NOMEEQUIPAMENTO
                INNER JOIN PESQUISA p2 ON p2.NOME = p.NOMEPESQUISA
                INNER JOIN EMPREGADOCIENTISTA e2 ON e2.NOME = p2.NOMECIENTISTA
                INNER JOIN EMPREGADO e3 ON e2.NOME = e3.NOME
                WHERE e3.NOMEC = :NOMEC AND e3.NUMEROC = :NUMEROC";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('NOMEC', $NOMEC);
        $stmt->bindParam('NUMEROC', $NUMEROC);
        $stmt->execute();

        $equipamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return $equipamentos;
    }


    public static function getJazida($NOMEC, $NUMEROC)
    {
        $db = Database::instance()->db;

        $sql = "SELECT LATITUDE, LONGITUDE, NOMEREGIAO FROM JAZIDA j
                LEFT JOIN COLONIA c ON c.LATITUDEJ = j.LATITUDE AND c.LONGITUDEJ = j.LONGITUDE
                WHERE c.NUMERO = :NUMEROC AND c.NOME = :NOMEC";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('NOMEC', $NOMEC);
        $stmt->bindParam('NUMEROC', $NUMEROC);
        $stmt->execute();

        $jazida = $stmt->fetch(PDO::FETCH_ASSOC);

        return $jazida;
    }

    public static function getMaquinarios($NOMEC, $NUMEROC)
    {
        $db = Database::instance()->db;

        $sql = "SELECT m.NOME FROM MAQUINARIO m
                INNER JOIN COLONIA c ON c.LATITUDEJ = m.LATITUDEJ AND c.LONGITUDEJ = c.LONGITUDEJ
                WHERE c.NUMERO = :NUMEROC AND c.NOME = :NOMEC";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('NOMEC', $NOMEC);
        $stmt->bindParam('NUMEROC', $NUMEROC);
        $stmt->execute();

        $maquinarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $maquinarios;
    }


}
