<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContainerResidencia $model */

$this->title = 'Update Container Residencia: ' . $model->SIGLA;
$this->params['breadcrumbs'][] = ['label' => 'Container Residencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SIGLA, 'url' => ['view', 'SIGLA' => $model->SIGLA, 'NOME' => $model->NOME]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-residencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
