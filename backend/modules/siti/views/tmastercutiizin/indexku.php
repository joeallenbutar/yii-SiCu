<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TMasterCutiIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmaster-cutiizin-indexku">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPegawai.nama',
            'kuota_cuti',
            'kuota_cuti_n',
            'kuota_cuti_m',
            'kuota_cuti_k',
            'kuota_cuti_d',
            'jlh_izin',
        ],
    ]); ?>


    <p><a class="btn btn-success" href="http://localhost/siti/backend/web/index.php?r=siti%2Ftpermohonan-cuti%2Fcreate">Request Cuti</a>
    <a class="btn btn-primary" href="http://localhost/siti/backend/web/index.php?r=siti%2Ftpermohonan-izin%2Fcreate">Request Izin</a>
    </p>
</div>
