<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContainerResidencia $model */

$this->title = 'Create Container Residencia';
$this->params['breadcrumbs'][] = ['label' => 'Container Residencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-residencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
