<?php

use app\models\ConsultasHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContainerResidencia $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container-residencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SIGLA')->textInput(['maxlength' => true, 'readOnly' => $update ?? false]) ?>

    <?= $form->field($model, 'NOME')->textInput(['maxlength' => true, 'readOnly' => $update ?? false]) ?>

    <?= $form->field($model, 'TAMANHO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FUNCAO')->textInput(['maxlength' => true, 'readOnly' => true]) ?>

    <?= $form->field($model, 'colonia')->dropDownList(ConsultasHelper::getColonias()) ?>

    <?= $form->field($model, 'QUANTIDADE_CAMAS')->textInput() ?>

    <?= $form->field($model, 'QUANTIDADE_BANHEIROS')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
