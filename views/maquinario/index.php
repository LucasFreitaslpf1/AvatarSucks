<?php

use app\models\Maquinario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MaquinarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Maquinarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maquinario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Maquinario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NOME',
            'TIPO',
            'POTENCIA',
            'PESO',
            'CAPACIDADE',
            'LATITUDEJ',
            'LONGITUDEJ',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'NOME' => $model['NOME'], 'TIPO' => $model['TIPO']]);
                }
            ],
        ],
    ]); ?>


</div>
