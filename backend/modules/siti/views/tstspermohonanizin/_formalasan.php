<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStsPermohonanIzin */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Alasan Reject';
?>

<div class="tstspermohonanizin-form">
    <h3>Alasan Reject</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alasan_reject')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Skip', ['view','id'=>$model->id_status], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
