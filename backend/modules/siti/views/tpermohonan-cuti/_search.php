<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanCutiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpermohonan-cuti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pcuti') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_jcuti') ?>

    <?= $form->field($model, 'tgl_pengajuan') ?>

    <?= $form->field($model, 'tgl_mulai_cuti') ?>

    <?php // echo $form->field($model, 'tgl_akhir_cuti') ?>

    <?php // echo $form->field($model, 'lama_cuti') ?>

    <?php // echo $form->field($model, 'alasan_cuti') ?>

    <?php // echo $form->field($model, 'id_atasan') ?>

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
