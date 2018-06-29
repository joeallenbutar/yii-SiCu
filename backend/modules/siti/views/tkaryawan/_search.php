<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\TKaryawanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="TKaryawan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nik') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'inisial') ?>

    <?php // echo $form->field($model, 'id_sex') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'd_lahir') ?>

    <?php // echo $form->field($model, 'status_kawin') ?>

    <?php // echo $form->field($model, 'd_aw_kerja') ?>

    <?php // echo $form->field($model, 'status_now') ?>

    <?php // echo $form->field($model, 'unit_kerja') ?>

    <?php // echo $form->field($model, 'status_kepeg') ?>

    <?php // echo $form->field($model, 'key_sys_user') ?>

    <?php // echo $form->field($model, 'pendidikan_now') ?>

    <?php // echo $form->field($model, 'id_jabatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
