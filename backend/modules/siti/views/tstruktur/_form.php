<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\siti\models\TJabatan;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStruktur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tstruktur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_atasan')->dropDownList(
    ArrayHelper::map(TJabatan::find()->all(),'id_jabatan','jabatan'),
            ['prompt'=>'Pilih Jabatan']
            ) ?>

    <?= $form->field($model, 'id_bawahan')->dropDownList(
    ArrayHelper::map(TJabatan::find()->all(),'id_jabatan','jabatan'),
            ['prompt'=>'Pilih Jabatan']
            ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
