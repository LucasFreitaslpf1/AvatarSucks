<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pesquisa $model */

$this->title = 'Create Pesquisa';
$this->params['breadcrumbs'][] = ['label' => 'Pesquisas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesquisa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
