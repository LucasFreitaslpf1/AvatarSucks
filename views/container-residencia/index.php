<?php

use app\models\ContainerResidencia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ContainerResidenciaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Container Residencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-residencia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Container Residencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SIGLA',
            'NOME',
            'QUANTIDADE_CAMAS',
            'QUANTIDADE_BANHEIROS',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'SIGLA' => $model['SIGLA'], 'NOME' => $model['NOME']]);
                }
            ],
        ],
    ]); ?>


</div>
