<?php

namespace app\models;

use PDO;
use PDOStatement;
use Yii;

class Database
{
    private static ?Database $instance = null;
    public PDO $db;

    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $db = Yii::$app->db;
        $this->db = new PDO($db->dsn, $db->username, $db->password);
    }

    public static function debugStatement(PDOStatement $stmt): void
    {
        ob_start();
        $stmt->debugDumpParams();
        Yii::debug(ob_get_clean());
    }
}
