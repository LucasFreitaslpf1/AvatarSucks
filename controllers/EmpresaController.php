<?php

namespace app\controllers;

use app\models\Database;
use app\models\Empresa;
use app\models\EmpresaSearch;
use PDO;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class EmpresaController extends Controller
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
     * Lists all Empresa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmpresaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empresa model.
     * @param string $REGISTRO
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($REGISTRO)
    {
        return $this->render('view', [
            'model' => $this->findModel($REGISTRO),
        ]);
    }

    /**
     * Creates a new Empresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Empresa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->salvar()) {
                return $this->redirect(['view', 'REGISTRO' => $model->REGISTRO]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Empresa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $REGISTRO
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($REGISTRO)
    {
        $model = $this->findModel($REGISTRO);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->atualizar($REGISTRO)) {
            return $this->redirect(['view', 'REGISTRO' => $model->REGISTRO]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Empresa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $REGISTRO
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($REGISTRO)
    {
        $this->findModel($REGISTRO)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Empresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $REGISTRO
     * @return Empresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($REGISTRO)
    {
        $db = Database::instance()->db;
        $stmt = $db->prepare('SELECT REGISTRO, NOME, SIGLA FROM EMPRESA WHERE REGISTRO = :REGISTRO');
        $stmt->bindParam('REGISTRO', $REGISTRO);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $model = new Empresa();
            $model->setAttributes($result);
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
