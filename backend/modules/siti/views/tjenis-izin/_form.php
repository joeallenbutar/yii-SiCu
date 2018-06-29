<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TJenisIzin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trjenis-izin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_izin')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'lama_izin')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
