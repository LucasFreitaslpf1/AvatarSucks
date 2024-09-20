<?php

use app\models\ConsultasHelper;
use app\models\Maquinario;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Maquinario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="maquinario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOME')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'TIPO')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'POTENCIA')->textInput() ?>
    <?= $form->field($model, 'PESO')->textInput() ?>
    <?= $form->field($model, 'CAPACIDADE')->textInput() ?>
    <?= $form->field($model, 'LATITUDEJ')->dropDownList(ConsultasHelper::getLatitude()) ?>
    <?= $form->field($model, 'LONGITUDEJ')->dropDownList(ConsultasHelper::getLongitude()) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
