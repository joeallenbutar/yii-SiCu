<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\siti\models\TKaryawan;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TMasterCutiIzin */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tmaster-cutiizin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kuota_cuti')->textInput() ?>
    <?= $form->field($model, 'kuota_cuti_n')->textInput() ?>
    <?= $form->field($model, 'kuota_cuti_m')->textInput() ?>
    <?= $form->field($model, 'kuota_cuti_k')->textInput() ?>
    <?= $form->field($model, 'kuota_cuti_d')->textInput() ?>
    <?= $form->field($model, 'jlh_izin')->textInput() ?>

    <?php // $form->field($model, 'lama_kerja')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
