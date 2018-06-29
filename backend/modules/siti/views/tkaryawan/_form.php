<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\TKaryawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tkaryawan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => 45, 'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'inisial')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'id_sex')->dropDownList([ 'Male' => 'Laki-Laki', 'Female' => 'Perempuan',], ['prompt' => 'Jenis Kelamin']) ?>


    <?= $form->field($model, 'status_kawin')->dropDownList([ 'Kawin' => 'Kawin', 'BK' => 'Belum Kawin',], ['prompt' => 'Status']) ?>

    <?= $form->field($model, 'd_aw_kerja')->textInput() ?>



    <?= $form->field($model, 'status_kepeg')->dropDownList([ 'Permanent' => 'Permanen', 'Daily' => 'Harian', 'Contract' => 'Kontrak',], ['prompt' => 'Status Kepegawaian']) ?>



    <?= $form->field($model, 'id_jabatan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
