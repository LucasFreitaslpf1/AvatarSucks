<?php

namespace app\controllers;

use app\models\ContainerResidencia;
use app\models\ContainerResidenciaSearch;
use app\models\Database;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PDO;
use yii;

/**
/**
 * ContainerResidenciaController implements the CRUD actions for ContainerResidencia model.
 */
class ContainerResidenciaController extends Controller
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
     * Lists all ContainerResidencia models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContainerResidenciaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContainerResidencia model.
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
     * Creates a new ContainerResidencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ContainerResidencia();
        $model->FUNCAO = 'Residência';

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
     * Updates an existing ContainerResidencia model.
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
     * Deletes an existing ContainerResidencia model.
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
     * Finds the ContainerResidencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $SIGLA Sigla
     * @param string $NOME Nome
     * @return ContainerResidencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($SIGLA, $NOME)
    {
        $db = Database::instance()->db;
        $stmt = $db->prepare("SELECT NOME, SIGLA, TAMANHO, FUNCAO, NUMEROC, NOMEC, CONTAINERRESIDENCIA.QUANTIDADE_CAMAS, CONTAINERRESIDENCIA.QUANTIDADE_BANHEIROS FROM CONTAINER
        NATURAL JOIN CONTAINERRESIDENCIA WHERE SIGLA = :SIGLA AND NOME = :NOME");
        $stmt->bindParam('NOME', $NOME);
        $stmt->bindParam('SIGLA', $SIGLA);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Yii::debug($result);
        if ($result) {
            $model = new ContainerResidencia();
            $model->setAttributes($result);
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
