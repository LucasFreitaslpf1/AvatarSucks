<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Database;
use PDO;
use Symfony\Component\VarDumper\Cloner\Data;
use yii\data\ArrayDataProvider;

class RelatorioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $db = Database::instance()->db;

        $sql = "SELECT NUMERO, NOME, APELIDO, PRESSURIZADA, REGISTRO_EMP, LATITUDEJ, LONGITUDEJ FROM COLONIA";

        // $sql = "SELECT c.NOME, c.NUMERO, c.APELIDO, c.PRESSURIZADA, c.REGISTRO_EMP, j.LATITUDE, j.LONGITUDE,
        //         LISTAGG(DISTINCT p.NOME, ';') AS PESQUISAS,
        //         LISTAGG(DISTINCT e2.NOME, ';') AS HUMANOS, 
        //         LISTAGG(DISTINCT e3.NOME,';') AS EQUIPAMENTOS,
        //         LISTAGG(DISTINCT m.NOME, ';') AS MAQUINARIOS
        //         FROM COLONIA c
        //         LEFT JOIN EMPREGADO e ON c.NUMERO = e.NUMEROC AND c.NOME = e.NOMEC 
        //         LEFT JOIN EMPREGADOCIENTISTA e2 ON e2.NOME = e.NOME
        //         LEFT JOIN PESQUISA p ON p.NOMECIENTISTA = e2.NOME
        //         LEFT JOIN PESQUISAEQUIPAMENTO p2 ON p2.NOMEPESQUISA = p.NOME 
        //         LEFT JOIN EQUIPAMENTO e3 ON e3.NOME = p2.NOMEEQUIPAMENTO
        //         LEFT JOIN JAZIDA j ON c.LATITUDEJ = j.LATITUDE AND c.LONGITUDEJ = j.LONGITUDE
        //         LEFT JOIN MAQUINARIO m ON m.LATITUDEJ = j.LATITUDE AND m.LONGITUDEJ = j.LONGITUDE
        //         GROUP BY c.NOME, c.NUMERO, c.APELIDO, c.PRESSURIZADA, c.REGISTRO_EMP, j.LATITUDE, j.LONGITUDE";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}
