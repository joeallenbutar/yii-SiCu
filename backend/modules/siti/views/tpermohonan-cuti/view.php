<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;
use yii\web\UrlManager;
use backend\modules\siti\models\TKaryawan;
use backend\modules\siti\models\TJabatan;
use backend\modules\siti\models\TMasterCutiIzin;
use backend\modules\siti\models\TStsPermohonanCuti;
use kartik\growl\Growl;
/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanCuti */

$this->title = 'View Permohonan Cuti';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tpermohonan-cuti-view">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>
    <?= Html::a('Update', ['update', 'id' => $model->id_pcuti], ['class' => 'btn btn-danger']) ?>
    <?=
    Html::a('Delete', ['delete', 'id' => $model->id_pcuti], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ])
    ?>
    </p>-->

    <?php
    if (Yii::$app->session->hasFlash('note')):
        ?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('note'); ?>
        </div>
        <?php
    endif;
    ?>

    <?php
    $atasan = TKaryawan::findOne(['id_jabatan' => $model->id_atasan]);
    $jabatan = TJabatan::findOne(['id_jabatan' => $model->id_atasan]);
    $model2 = TMasterCutiIzin::findOne(['id_karyawan' => $model->id]);
    $model3 = TKaryawan::findOne(['id' => $model->id]);
    ?>

    <table class="status">
        <tr>
            <th class="tampilanView">Nama Pemohon</th>
            <th class="tampilanView">Kuota Cuti</th>
            <th class="tampilanView">Tanggal Pengajuan</th>
            <th class="tampilanView">Tanggal Mulai Cuti</th>
            <th class="tampilanView">Tanggal Akhir Cuti</th>
            <th class="tampilanView">Lama Cuti</th>
            <th class="tampilanView">Alasan</th>
        </tr>
        <tr>
            <td class="tampilanView"><?php echo $model3->nama; ?></td>
            <td class="tampilanView"><?php echo $model2->kuota_cuti; ?></td>
            <td class="tampilanView"><?php echo $model->tgl_pengajuan; ?></td>
            <td class="tampilanView"><?php echo $model->tgl_mulai_cuti; ?></td>
            <td class="tampilanView"><?php echo $model->tgl_akhir_cuti; ?></td>
            <td class="tampilanView"><?php echo $model->lama_cuti; ?></td>
            <td class="tampilanView"><?php echo $model->alasan_cuti; ?></td>
        </tr>
        <tr>

    </table>
    <hr>

    <?php $model1 = TStsPermohonanCuti::findOne(['id_pcuti' => $model->id_pcuti]); ?>
    <table class="status">
        <tr>
            <th class="tampilanView">Pengalihan Tugas</th>
            <th class="tampilanView">Nama Atasan</th>
            <th class="tampilanView">Jabatan Atasan</th>
            <th class="tampilanStatus">Status</th>
            <?php if($model1->status=="Reject Atasan Langsung" || $model1->status=="Reject Wakil Rektor 2"){?>
            <th class="tampilanStatus">Alasan Reject</th>
            <?php  }?>

        </tr>
        <tr>
            <td class="tampilanView"><?php echo $model->pengalihan; ?></td>
            <td class="tampilanView"><?php echo $atasan->nama; ?></td>
            <td class="tampilanView"><?php echo $jabatan->jabatan; ?></td>
            <td class="tampilanStatus"><?php echo $model1->status; ?></td>
            <?php if($model1->status=="Reject Atasan Langsung" || $model1->status=="Reject Wakil Rektor 2"){?>
            <td class="tampilanStatus"><?php echo $model1->alasan_reject; ?></td>
            <?php }?>

        </tr>
    </table>
    <hr>

    <?php
    $status = TStsPermohonanCuti::getStatusKonfirm($model->id_pcuti);
    if ($status == true && $model1->status == "Belum Dikonfirmasi") {
        ?>
        <?= Html::a('Confirm', ['tstspermohonancuti/confirm', 'id' => $model->id_pcuti], ['class' => 'btn btn-success']) ?>
    <?php } ?>

    <?php
    $status = TStsPermohonanCuti::getStatusKonfirm($model->id_pcuti);
    if ($status == true && $model1->status == "Belum Dikonfirmasi") {
        ?>
        <?= Html::a('Reject', ['tstspermohonancuti/reject', 'id' => $model->id_pcuti], ['class' => 'btn btn-danger']) ?>
    <?php } ?>

    <?php
    $status = TStsPermohonanCuti::getStatusKonfirmWR2($model->id_pcuti);
    if ($status == true && $model1->status == "Confirm Atasan Langsung") {
        ?>
        <?= Html::a('Confirm', ['tstspermohonancuti/confirmwr2', 'id' => $model->id_pcuti], ['class' => 'btn btn-success'], (['id' => $model->id_pcuti])) ?>
    <?php } ?>

    <?php
    $status = TStsPermohonanCuti::getStatusKonfirmWR2($model->id_pcuti);
    if ($status == true && $model1->status == "Confirm Atasan Langsung") {
        ?>
        <?= Html::a('Reject', ['tstspermohonancuti/rejectwr2', 'id' => $model->id_pcuti], ['class' => 'btn btn-danger'], (['id' => $model->id_pcuti])) ?>
    <?php } ?>

    <?php
    $status = TStsPermohonanCuti::getStatusCetak($model->id_pcuti);
    if ($status == true && $model1->status == "Confirm Wakil Rektor 2") {
        ?>
        <?= Html::a('Print', ['tpermohonan-cuti/cetak', 'id' => $model->id_pcuti], ['class' => 'btn btn-primary'], (['id' => $model->id_pcuti])) ?>
    <?php } ?>

    <?php
    $status = TStsPermohonanCuti::getStatusCetak($model->id_pcuti);
    if ($status == true && $model->id_atasan == 1 && $model1->status == "Confirm Atasan Langsung") {
        ?>
       <?php } ?>

    <?php
    $status = TStsPermohonanCuti::getStatusAkhiri($model->id_pcuti);
    if ($status == true && $model1->status == "Belum Dikonfirmasi") {
        ?>
        <?= Html::a('Cancel', ['tstspermohonancuti/cancel', 'id' => $model->id_pcuti], ['class' => 'btn btn-danger'], (['id' => $model->id_pcuti])) ?>
    <?php } ?>

</div>
