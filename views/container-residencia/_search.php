<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContainerResidenciaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container-residencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'SIGLA') ?>

    <?= $form->field($model, 'NOME') ?>

    <?= $form->field($model, 'QUANTIDADE_CAMAS') ?>

    <?= $form->field($model, 'QUANTIDADE_BANHEIROS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
