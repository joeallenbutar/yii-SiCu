<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanIzinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpermohonan-izin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pizin') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_jizin') ?>

    <?= $form->field($model, 'tgl_pengajuan') ?>

    <?= $form->field($model, 'lama_izin') ?>

    <?php // echo $form->field($model, 'id_atasan') ?>

    <?php // echo $form->field($model, 'alasan_izin') ?>

    <?php // echo $form->field($model, 'tgl_mulai_izin') ?>

    <?php // echo $form->field($model, 'tgl_akhir_izin') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
