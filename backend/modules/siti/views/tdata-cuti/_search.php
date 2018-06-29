<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TDataCutiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tdata-cuti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_cuti') ?>

    <?= $form->field($model, 'id_pcuti') ?>

    <?= $form->field($model, 'tgl_sah') ?>

    <?= $form->field($model, 'lama_sah') ?>

    <?= $form->field($model, 'tgl_sah_mulai') ?>

    <?php // echo $form->field($model, 'tgl_sah_akhir') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
