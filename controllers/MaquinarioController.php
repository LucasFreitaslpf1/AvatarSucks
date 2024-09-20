<?php

namespace app\controllers;

use app\models\ConsultasHelper;
use app\models\Database;
use app\models\Maquinario;
use app\models\MaquinarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PDO;
use yii;

/**
 * MaquinarioController implements the CRUD actions for Maquinario model.
 */
class MaquinarioController extends Controller
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
     * Lists all Maquinario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MaquinarioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Maquinario model.
     * @param string $NOME
     * @param string $TIPO
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($NOME, $TIPO)
    {
        return $this->render('view', [
            'model' => $this->findModel($NOME, $TIPO),
        ]);
    }

    /**
     * Creates a new Maquinario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        Yii::debug(ConsultasHelper::getJazidas());
        $model = new Maquinario();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'NOME' => $model->NOME, 'TIPO' => $model->TIPO]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Maquinario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $NOME
     * @param string $TIPO
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($NOME, $TIPO)
    {
        $model = $this->findModel($NOME, $TIPO);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->update($NOME, $TIPO)) {
            return $this->redirect(['view', 'NOME' => $model->NOME, 'TIPO' => $model->TIPO]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Maquinario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $NOME
     * @param string $TIPO
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($NOME, $TIPO)
    {
        $this->findModel($NOME, $TIPO)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Maquinario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $NOME
     * @param string $TIPO
     * @return Maquinario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($NOME, $TIPO)
    {
        $db = Database::instance()->db;
        $stmt = $db->prepare("SELECT NOME, TIPO, POTENCIA, PESO, CAPACIDADE, LATITUDEJ, LONGITUDEJ FROM MAQUINARIO WHERE NOME = :NOME AND TIPO = :TIPO");
        $stmt->bindParam(':NOME', $NOME);
        $stmt->bindParam(':TIPO', $TIPO);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $model = new Maquinario();
            $model->setAttributes($result);
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
