<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStsPermohonanCuti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tstspermohonancuti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pcuti')->textInput() ?>

    <?= $form->field($model, 'jlh_permohonan')->textInput() ?>

    <?= $form->field($model, 'id_atasan')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
