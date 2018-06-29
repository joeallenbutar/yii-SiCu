<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TDataCuti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tdata-cuti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pcuti')->textInput() ?>

    <?= $form->field($model, 'tgl_sah')->textInput() ?>

    <?= $form->field($model, 'lama_sah')->textInput() ?>

    <?= $form->field($model, 'tgl_sah_mulai')->textInput() ?>

    <?= $form->field($model, 'tgl_sah_akhir')->textInput() ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
