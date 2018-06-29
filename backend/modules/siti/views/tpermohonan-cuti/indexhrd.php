<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TPermohonanCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpermohonan-cuti-index">
    <h2>Permohonan Cuti :</h2>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_pcuti',
            'id0.nama',
            'idJcuti.nama_cuti',
            'tgl_pengajuan',
            'lama_cuti',
            // 'id_atasan',
            // 'alasan_cuti',
            'tgl_mulai_cuti',
            'tgl_akhir_cuti',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'deleted',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>

<div class="tpermohonan-cuti-index">
    <h2>Semua Permohonan Cuti :</h2>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider1,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_pcuti',
            'id0.nama',
            'idJcuti.nama_cuti',
            'tgl_pengajuan',
            'lama_cuti',
            // 'id_atasan',
            // 'alasan_cuti',
            'tgl_mulai_cuti',
            'tgl_akhir_cuti',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'deleted',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
