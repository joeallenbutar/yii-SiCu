<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TPermohonanIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Izin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpermohonan-izin-index">
    <h2>Permohonan Izin :</h2>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_pizin',
            'id0.nama',
            'idJizin.nama_izin',
            'tgl_pengajuan',
            'lama_izin',
            // 'id_atasan',
            // 'alasan_izin',
            'tgl_mulai_izin',
            'tgl_akhir_izin',
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

<div class="tpermohonan-izin-index">
    <h2>Semua Permohonan Izin :</h2>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider1,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_pizin',
            'id0.nama',
            'idJizin.nama_izin',
            'tgl_pengajuan',
            'lama_izin',
            // 'id_atasan',
            // 'alasan_izin',
            'tgl_mulai_izin',
            'tgl_akhir_izin',
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
