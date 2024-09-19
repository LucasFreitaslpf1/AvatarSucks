<?php

namespace app\controllers;

use app\models\Database;
use app\models\Pesquisa;
use app\models\PesquisaSearch;
use PDO;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PesquisaController implements the CRUD actions for Pesquisa model.
 */
class PesquisaController extends Controller
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
     * Lists all Pesquisa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PesquisaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pesquisa model.
     * @param string $NOME Nome
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($NOME)
    {
        return $this->render('view', [
            'model' => $this->findModel($NOME),
        ]);
    }

    /**
     * Creates a new Pesquisa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pesquisa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->salvar()) {
                return $this->redirect(['view', 'NOME' => $model['NOME']]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pesquisa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $NOME Nome
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($NOME)
    {
        $model = $this->findModel($NOME);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->atualizar($NOME)) {
            return $this->redirect(['view', 'NOME' => $model['NOME']]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pesquisa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $NOME Nome
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($NOME)
    {
        $this->findModel($NOME)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pesquisa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $NOME Nome
     * @return Pesquisa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($NOME)
    {
        $db = Database::instance()->db;
        $stmt = $db->prepare("SELECT NOME, NOMELABORATORIO, SIGLALABORATORIO, NOMECIENTISTA FROM PESQUISA WHERE NOME = :NOME");
        $stmt->bindParam('NOME', $NOME);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $model = new Pesquisa();
            $model->setAttributes($result);
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
