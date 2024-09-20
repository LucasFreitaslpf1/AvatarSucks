<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContainerDeposito $model */

$this->title = 'Update Container Deposito: ' . $model->SIGLA;
$this->params['breadcrumbs'][] = ['label' => 'Container Depositos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SIGLA, 'url' => ['view', 'SIGLA' => $model->SIGLA, 'NOME' => $model->NOME]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-deposito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'update' => true,
    ]) ?>

</div>
