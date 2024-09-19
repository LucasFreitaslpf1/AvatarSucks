<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pesquisa $model */

$this->title = 'Update Pesquisa: ' . $model->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Pesquisas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NOME, 'url' => ['view', 'NOME' => $model->NOME]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pesquisa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
