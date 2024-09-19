<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Pesquisa $model */

$this->title = $model->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Pesquisas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pesquisa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'NOME' => $model->NOME], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'NOME' => $model->NOME], [
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
            'NOME',
            'NOMELABORATORIO',
            'SIGLALABORATORIO',
            'NOMECIENTISTA',
        ],
    ]) ?>

</div>
