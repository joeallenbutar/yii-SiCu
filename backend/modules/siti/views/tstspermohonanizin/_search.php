<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStsPermohonanIzinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trstspermohonanizin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_status') ?>

    <?= $form->field($model, 'id_pizin') ?>

    <?= $form->field($model, 'jlh_permohonan') ?>

    <?= $form->field($model, 'id_atasan') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'alasan_reject') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
