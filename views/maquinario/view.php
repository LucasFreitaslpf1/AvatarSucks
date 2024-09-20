<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Maquinario $model */

$this->title = $model->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Maquinarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="maquinario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'NOME' => $model->NOME, 'TIPO' => $model->TIPO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'NOME' => $model->NOME, 'TIPO' => $model->TIPO], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem Certeza que deseja excluir esse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'NOME',
            'TIPO',
            'POTENCIA',
            'PESO',
            'CAPACIDADE',
            'LATITUDEJ',
            'LONGITUDEJ',
        ],
    ]) ?>

</div>
