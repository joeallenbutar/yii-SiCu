<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;
use yii\web\UrlManager;
use backend\modules\siti\models\TKaryawan;
use backend\modules\siti\models\TJabatan;
use backend\modules\siti\models\TMasterCutiIzin;
use backend\modules\siti\models\TStsPermohonanIzin;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanIzin */

$this->title = 'View Permohonan Izin';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpermohonan-izin-view">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_pizin], ['class' => 'btn btn-danger']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id_pizin], [
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
    $model2 = TMasterCutiIzin::findOne(['id_pegawai' => $model->id]);
    $model3 = TKaryawan::findOne(['id' => $model->id]);
    ?>

    <table class="status">
        <tr>
            <th class="tampilanView">Nama Pemohon</th>
            <th class="tampilanView">Kuota Izin</th>
            <th class="tampilanView">Tanggal Pengajuan</th>
            <th class="tampilanView">Tanggal Mulai Izin</th>
            <th class="tampilanView">Tanggal Akhir Izin</th>
            <th class="tampilanView">Lama Izin</th>
            <th class="tampilanView">Alasan</th>
        </tr>
        <tr>
            <td class="tampilanView"><?php echo $model3->nama; ?></td>
            <td class="tampilanView"><?php echo $model2->jlh_izin; ?></td>
            <td class="tampilanView"><?php echo $model->tgl_pengajuan; ?></td>
            <td class="tampilanView"><?php echo $model->tgl_mulai_izin; ?></td>
            <td class="tampilanView"><?php echo $model->tgl_akhir_izin; ?></td>
            <td class="tampilanView"><?php echo $model->lama_izin; ?></td>
            <td class="tampilanView"><?php echo $model->alasan_izin; ?></td>
        </tr>
    </table>
    <hr>


    <?php $model1 = TStsPermohonanIzin::findOne(['id_pizin' => $model->id_pizin]); ?>
    <table class="status">
        <tr>
            <th class="tampilanView">Pengalihan Tugas</th>
            <th class="tampilanView">Nama Atasan</th>
            <th class="tampilanView">Jabatan Atasan</th>
            <th class="tampilanStatus">Status</th>
            <?php if($model1->status=="Reject Atasan Langsung"){?>
            <th class="tampilanStatus">Alasan Reject</th>
            <?php  }?>

        </tr>
        <tr>
            <td class="tampilanView"><?php echo $model->pengalihan; ?></td>
            <td class="tampilanView"><?php echo $atasan->nama; ?></td>
            <td class="tampilanView"><?php echo $jabatan->jabatan; ?></td>
            <td class="tampilanStatus"><?php echo $model1->status; ?></td>
            <?php if($model1->status=="Reject Atasan Langsung"){?>
            <td class="tampilanStatus"><?php echo $model1->alasan_reject; ?></td>
            <?php }?>
        </tr>
    </table>
    <hr>

     <?php
    $status = TStsPermohonanIzin::getStatusKonfirm($model->id_pizin);
if ($status == true && $model1->status=="Belum Dikonfirmasi") { ?>
    <?= Html::a('Confirm', ['trstatus-permohonanizin/confirm','id' => $model->id_pizin], ['class'=>'btn btn-success']) ?>
<?php } ?>

    <?php $status = TStsPermohonanIzin::getStatusKonfirm($model->id_pizin);
if ($status == true && $model1->status=="Belum Dikonfirmasi") { ?>
    <?= Html::a('Reject', ['trstatus-permohonanizin/reject','id' => $model->id_pizin], ['class'=>'btn btn-danger']) ?>
<?php } ?>

     <?php $status = TStsPermohonanIzin::getStatusCetak($model->id_pizin);
if ($status == true && $model1->status=="Confirm Atasan Langsung") { ?>
    <?= Html::a('Print', ['tpermohonan-izin/cetak','id' => $model->id_pizin], ['class'=>'btn btn-primary'],(['id' => $model->id_pizin])) ?>
<?php } ?>

     <?php $status = TStsPermohonanIzin::getStatusAkhiri($model->id_pizin);
if ($status == true && $model1->status=="Belum Dikonfirmasi") { ?>
    <?= Html::a('Cancel', ['trstatus-permohonanizin/cancel','id' => $model->id_pizin], ['class'=>'btn btn-danger'],(['id' => $model->id_pizin])) ?>
<?php } ?>
</div>
