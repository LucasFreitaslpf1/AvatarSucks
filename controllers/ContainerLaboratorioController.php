<?php

namespace app\controllers;

use app\models\ContainerLaboratorio;
use app\models\ContainerLaboratorioSearch;
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
                    'class' => VerbFilter::className(),
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

        if ($model->load(Yii::$app->request->post()) && $model->saveContainerLaboratorio()) {
            return $this->redirect(['view', 'id' => $model->SIGLA]);
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
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
        if (($model = ContainerLaboratorio::findOne(['SIGLA' => $SIGLA, 'NOME' => $NOME])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Página Inexistente.');
    }
}
