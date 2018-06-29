<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\siti\models\TJabatan;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\modules\siti\models\SignupForm */

$this->title = 'Tambah Karyawan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Harap mengisi data-data karyawan berikut:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'nik') ?>
                <?= $form->field($model, 'nama') ?>
                <?= $form->field($model, 'no_hp') ?>
                <?= $form->field($model, 'inisial') ?>
                <?= $form->field($model, 'id_sex')->dropDownList(array ('Male' =>'Male','Female'=>'Female')) ?>
                <?= $form->field($model, 'status_kawin')->dropDownList(array(['Kawin'=>'Kawin','Belum Kawin'=>"Belum Kawin"])) ?>
                <?= $form->field($model, 'status_kepeg')->dropDownList(array(['Permanent'=>'Permanent','Contract'=>'Contract'])) ?>
                <?= $form->field($model, 'id_jabatan')->dropDownList(ArrayHelper::map(TJabatan::find()->all(),'id_jabatan','jabatan'),['prompt'=>'Pilih Jabatan']) ?>
                <?= $form->field($model, 'kuota_cuti') ?>
                <?= $form->field($model, 'kuota_cuti_n') ?>
                <?= $form->field($model, 'kuota_cuti_m') ?>
                <?= $form->field($model, 'kuota_cuti_k') ?>
                <?= $form->field($model, 'kuota_cuti_d') ?>
                <?= $form->field($model, 'jlh_izin') ?>

                <div class="form-group">
                    <?= Html::submitButton('Tambah Karyawan', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
