<?php


use dosamigos\datetimepicker\DateTimePicker;
//use dosamigos\tinymce\TinyMce;
use dosamigos\datepicker\DatePicker;
use yii\db\ActiveQuery;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\siti\models\TKaryawan;
use backend\modules\siti\models\User;
use backend\modules\siti\models\TStruktur;
use backend\modules\siti\models\TJenisCuti;
use backend\modules\siti\models\TJabatan;
use backend\modules\siti\models\TMasterCutiIzin;
use kartik\growl\Growl;
/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanCuti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpermohonan-cuti-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $start= date('Y-m-d h:m:s');?>
    <?php
    $id = Yii::$app->user->Id;
    $user = \backend\modules\siti\models\User:: findOne($id);
    $kar = User::findOne(['id' => Yii::$app->user->id]);
    $nik = TKaryawan::findOne(['nik' => $kar->nik]);
    $idkar = TKaryawan::findOne(['id' => $kar->id]);
    $jabatan = TJabatan::findOne(['id_jabatan' => $nik->id_jabatan]);
    ?>

    <h4>Nama : <?php echo $nik->nama;?></h4>
    <h4>NIK : <?php echo $nik->nik;?></h4>
    <h4>No HP : <?php echo $nik->no_hp;?></h4>
    <h4>Jabatan : <?php echo $jabatan->jabatan;?></h4>
    <hr>
    <?=
    $form->field($model, 'id_jcuti')->dropDownList(ArrayHelper::map(TJenisCuti::find()->all(), 'id_jcuti', 'nama_cuti'), ['prompt' => 'Jenis Cuti']
    )
    ?>


    <?= $form->field($model, 'tgl_mulai_cuti')->widget(DatePicker::className(), [
    'language' => 'in',
    'template' => '{addon}{input}',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'showAnim' => 'fold',
        'showMeridian'=> true,
        'startDate'=>$start,
    ]
    ]);?>

    <?= $form->field($model, 'tgl_akhir_cuti')->widget(DatePicker::className(),[
    'language' => 'in',
    'template' => '{addon}{input}',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'showAnim' => 'fold',
        'showMeridian'=> true,
        'startDate'=>$start,
    ]
]);?>

    <?= $form->field($model, 'pengalihan')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'alasan_cuti')->textInput(['maxlength' => 500]) ?>


    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
