<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Maquinario $model */
//var_dump($model->NOME, $model->TIPO); 
//die();

$this->title = 'Update Maquinario: ' . $model->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Maquinarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NOME, 'url' => ['view', 'NOME' => $model->NOME, 'TIPO' => $model->TIPO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maquinario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
