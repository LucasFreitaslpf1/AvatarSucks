<?php

use app\models\ConsultasHelper;
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
        'columns' => [
            'NUMERO',
            'NOME',
            'APELIDO',
            'PRESSURIZADA',
            'REGISTRO_EMP',
            'LATITUDEJ',
            'LONGITUDEJ',
            [
                'attribute' => 'humanos',
                'label' => 'Humanos',
                'value' => function ($model) {

                    $empregados = ConsultasHelper::getHumanoColonia($model['NOME'], $model['NUMERO']);

                    $result = '';

                    foreach ($empregados as $empregado) {
                        $result .= '' . $empregado['NOME'] . ' - ' . $empregado['PAPEL'] . ' <br> ';
                    }
                    return $result;
                },
                'format' => 'html', 

            ],
            [
                'attribute' => 'equipamentos',
                'label' => 'Equipamentos das Pesquisa da Colônia',
                'value' => function ($model) {

                    $equipamentos = ConsultasHelper::getEquipamentosColonia($model['NOME'], $model['NUMERO']);

                    $result = '';

                    foreach ($equipamentos as $equipamento) {
                        $result .= '' . $equipamento['NOME'] . ' <br> ';
                    }
                    return $result;
                },
                'format' => 'html', 
            ],
            [
                'attribute' => 'jazida',
                'label' => 'Jazida',
                'value' => function ($model) {

                    $jazida = ConsultasHelper::getJazida($model['NOME'], $model['NUMERO']);

       
                    return "{$jazida['LATITUDE']} - {$jazida['LONGITUDE']} - {$jazida['NOMEREGIAO']}";
                },
                'format' => 'html', 
            ],
            [
                'attribute' => 'maquinarios',
                'label' => 'Maquinarios',
                'value' => function ($model) {

                    $maquinarios = ConsultasHelper::getMaquinarios($model['NOME'],$model['NUMERO']);
                    $result = '';

                    foreach ($maquinarios as $maquinario) {
                        $result .= '' . $maquinario['NOME'] . ' <br> ';
                    }
                    return $result;
                },
                'format' => 'html', 
            ],
        ],
    ]); ?>


</div>
