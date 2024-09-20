<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContainerDeposito $model */

$this->title = 'Create Container Deposito';
$this->params['breadcrumbs'][] = ['label' => 'Container Depositos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-deposito-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
