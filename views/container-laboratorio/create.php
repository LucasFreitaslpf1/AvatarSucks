<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContainerLaboratorio $model */

$this->title = 'Create Container Laboratorio';
$this->params['breadcrumbs'][] = ['label' => 'Container Laboratorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-laboratorio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
