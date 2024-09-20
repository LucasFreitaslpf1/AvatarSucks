<?php

namespace app\controllers;

use app\models\ContainerDeposito;
use app\models\ContainerDepositoSearch;
use app\models\Database;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PDO;
use yii;

/**
/**
 * ContainerDepositoController implements the CRUD actions for ContainerDeposito model.
 */
class ContainerDepositoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ContainerDeposito models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContainerDepositoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContainerDeposito model.
     * @param string $SIGLA Sigla
     * @param string $NOME Nome
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($SIGLA, $NOME)
    {
        return $this->render('view', [
            'model' => $this->findModel($SIGLA, $NOME),
        ]);
    }

    /**
     * Creates a new ContainerDeposito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ContainerDeposito();
        $model->FUNCAO = "Depósito";

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'SIGLA' => $model->SIGLA, 'NOME' => $model->NOME]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ContainerDeposito model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $SIGLA Sigla
     * @param string $NOME Nome
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($SIGLA, $NOME)
    {
        $model = $this->findModel($SIGLA, $NOME);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->update($NOME, $SIGLA)) {
            return $this->redirect(['view', 'SIGLA' => $model->SIGLA, 'NOME' => $model->NOME]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContainerDeposito model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $SIGLA Sigla
     * @param string $NOME Nome
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($SIGLA, $NOME)
    {
        $this->findModel($SIGLA, $NOME)->delete($NOME, $SIGLA);

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContainerDeposito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $SIGLA Sigla
     * @param string $NOME Nome
     * @return ContainerDeposito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($SIGLA, $NOME)
    {
        $db = Database::instance()->db;
        $stmt = $db->prepare("SELECT NOME, SIGLA, TAMANHO, FUNCAO, NUMEROC, NOMEC, CONTAINERDEPOSITO.TIPO FROM CONTAINER
        NATURAL JOIN CONTAINERDEPOSITO WHERE SIGLA = :SIGLA AND NOME = :NOME");
        $stmt->bindParam('NOME', $NOME);
        $stmt->bindParam('SIGLA', $SIGLA);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Yii::debug($result);
        if ($result) {
            $model = new ContainerDeposito();
            $model->setAttributes($result);
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
