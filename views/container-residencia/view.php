<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ContainerResidencia $model */

$this->title = $model->SIGLA;
$this->params['breadcrumbs'][] = ['label' => 'Container Residencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-residencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'SIGLA' => $model->SIGLA, 'NOME' => $model->NOME], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'SIGLA' => $model->SIGLA, 'NOME' => $model->NOME], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'SIGLA',
            'NOME',
            'QUANTIDADE_CAMAS',
            'QUANTIDADE_BANHEIROS',
        ],
    ]) ?>

</div>
