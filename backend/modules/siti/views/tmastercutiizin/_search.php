<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TMasterCutiIzinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmaster-cutiizin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kuota_cuti') ?>

    <?= $form->field($model, 'kuota_cuti_n') ?>

    <?= $form->field($model, 'kuota_cuti_m') ?>

    <?= $form->field($model, 'kuota_cuti_k') ?>

    <?= $form->field($model, 'kuota_cuti_d') ?>

    <?= $form->field($model, 'jlh_izin') ?>

    <?= $form->field($model, 'lama_kerja') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
