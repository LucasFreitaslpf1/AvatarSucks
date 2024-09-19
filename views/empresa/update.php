<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Empresa $model */

$this->title = 'Update Empresa: ' . $model->REGISTRO;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->REGISTRO, 'url' => ['view', 'REGISTRO' => $model->REGISTRO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empresa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
