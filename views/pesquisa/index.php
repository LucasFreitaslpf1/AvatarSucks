<?php

use app\models\Pesquisa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PesquisaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pesquisas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesquisa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pesquisa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NOME',
            'NOMELABORATORIO',
            'SIGLALABORATORIO',
            'NOMECIENTISTA',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'NOME' => $model['NOME']]);
                }
            ],
        ],
    ]); ?>


</div>
