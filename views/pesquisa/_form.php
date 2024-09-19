<?php

use app\models\ConsultasHelper;
use app\models\Pesquisa;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pesquisa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pesquisa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMELABORATORIO')->dropDownList(ConsultasHelper::getLaboratorios())
        ->label('Laboratório') ?>
    <?= $form->field($model, 'NOMECIENTISTA')->dropDownList(ConsultasHelper::getCientistas()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
