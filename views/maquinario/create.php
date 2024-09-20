<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Maquinario $model */

$this->title = 'Create Maquinario';
$this->params['breadcrumbs'][] = ['label' => 'Maquinarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maquinario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
