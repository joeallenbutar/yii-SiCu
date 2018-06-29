<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TDataIzinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tdata-izin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_izin') ?>

    <?= $form->field($model, 'id_pizin') ?>

    <?= $form->field($model, 'tgl_sah') ?>

    <?= $form->field($model, 'lama_sah') ?>

    <?= $form->field($model, 'tgl_sah_mulai') ?>

    <?php // echo $form->field($model, 'tgl_sah_akhir') ?>

    <?php // echo $form->field($model, 'catatan') ?>

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
