<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Empresa $model */

$this->title = $model->REGISTRO;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empresa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'REGISTRO' => $model->REGISTRO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'REGISTRO' => $model->REGISTRO], [
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
            'REGISTRO',
            'NOME',
            'SIGLA',
        ],
    ]) ?>

</div>
