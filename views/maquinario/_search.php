<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MaquinarioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="maquinario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'NOME') ?>

    <?= $form->field($model, 'TIPO') ?>

    <?= $form->field($model, 'POTENCIA') ?>

    <?= $form->field($model, 'PESO') ?>

    <?= $form->field($model, 'CAPACIDADE') ?>

    <?php // echo $form->field($model, 'LATITUDEJ') ?>

    <?php // echo $form->field($model, 'LONGITUDEJ') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
