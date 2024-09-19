<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PesquisaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pesquisa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'NOME') ?>

    <?= $form->field($model, 'NOMELABORATORIO') ?>

    <?= $form->field($model, 'SIGLALABORATORIO') ?>

    <?= $form->field($model, 'NOMECIENTISTA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
