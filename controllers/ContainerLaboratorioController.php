<?php

namespace app\controllers;

use app\models\ContainerLaboratorio;
use app\models\ContainerLaboratorioSearch;
use app\models\Database;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PDO;
use yii;

/**
 * ContainerLaboratorioController implements the CRUD actions for ContainerLaboratorio model.
 */
class ContainerLaboratorioController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ContainerLaboratorio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContainerLaboratorioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContainerLaboratorio model.
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
     * Creates a new ContainerLaboratorio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ContainerLaboratorio();
        $model->FUNCAO = "Laboratório";

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'SIGLA' => $model->SIGLA, 'NOME' => $model->NOME]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing ContainerLaboratorio model.
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
     * Deletes an existing ContainerLaboratorio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $SIGLA Sigla
     * @param string $NOME Nome
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($SIGLA, $NOME)
    {
        $this->findModel($SIGLA, $NOME)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContainerLaboratorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $SIGLA Sigla
     * @param string $NOME Nome
     * @return ContainerLaboratorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($SIGLA, $NOME)
    {
        $db = Database::instance()->db;
        $stmt = $db->prepare("SELECT NOME, SIGLA, TAMANHO, FUNCAO, NUMEROC, NOMEC, CONTAINERLABORATORIO.FINALIDADE FROM CONTAINER
        NATURAL JOIN CONTAINERLABORATORIO WHERE SIGLA = :SIGLA AND NOME = :NOME");
        $stmt->bindParam('NOME', $NOME);
        $stmt->bindParam('SIGLA', $SIGLA);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Yii::debug($result);
        if ($result) {
            $model = new ContainerLaboratorio();
            $model->setAttributes($result);
            return $model;
        }


        throw new NotFoundHttpException('Página Inexistente.');
    }
}
