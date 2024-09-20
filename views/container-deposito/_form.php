<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContainerDeposito $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container-deposito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SIGLA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIPO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
