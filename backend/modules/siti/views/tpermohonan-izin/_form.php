<?php
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\Html;
use dosamigos\datepicker\DatePicker;
use yii\db\ActiveQuery;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\siti\models\TKaryawan;
use backend\modules\siti\models\User;
use backend\modules\siti\models\TStruktur;
use backend\modules\siti\models\TJenisIzin;
use backend\modules\siti\models\TJabatan;
use backend\modules\siti\models\TMasterCutiIzin;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanIzin */
/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="modal-dialog our-modal-dialog"style="width: 900px" >
<div class="modal-content ">
<div class="modal-header our-modal-header">
    <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
      <h1 class="modal-title our-modal-title" id="myModalLabel">Request Izin</h1>
</div>-->
<div class="tpermohonan-izin-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $start= date('Y-m-d h:m:s');?>
    <?php
    $id = Yii::$app->user->Id;
    $user = \backend\modules\siti\models\User:: findOne($id);
    $kar = User::findOne(['id' => Yii::$app->user->id]);
    $idkar = TKaryawan::findOne(['nik' => $kar->nik]);
    $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
    $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);
    ?>

    <h4>Nama : <?php echo $idkar->nama;?></h4>
    <h4>NIK : <?php echo $idkar->nik;?></h4>
    <h4>No HP : <?php echo $idkar->no_hp;?></h4>
    <h4>Jabatan : <?php echo $jabatan->jabatan;?></h4>
    <hr>
    <?=
    $form->field($model, 'id_jizin')->dropDownList(ArrayHelper::map(TJenisIzin::find()->all(), 'id_jizin', 'nama_izin'), ['prompt' => 'Jenis Izin']
    )
    ?>

   <?= $form->field($model, 'tgl_mulai_izin')->widget(DatePicker::className(), [
    'language' => 'in',
    'template' => '{addon}{input}',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayBtn' => true,
        'startDate'=>$start,
    ]
    ]);?>

    <?= $form->field($model, 'tgl_akhir_izin')->widget(DatePicker::className(),[
    'language' => 'in',
    'template' => '{addon}{input}',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayBtn' => true,
        'startDate'=>$start,
    ]
]);?>

    <?= $form->field($model, 'pengalihan')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'alasan_izin')->textInput(['maxlength' => 500]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!--<div class="modal-footer our-modal-footer">
   <div class="form-group our-form-group">
 </div>
</div>
    </div>
</div>  -->
