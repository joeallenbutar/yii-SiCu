<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\modules\siti\models\TPermohonanCuti;
use backend\modules\siti\models\TRStatusPermohonancuti;

use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TPermohonanCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Cuti';
$this->params['breadcrumbs'][] = $this->title;



?>

<div class="tpermohonan-cuti-index">

    <h2>Belum Direspon:</h2>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id_pcuti',
            //'idJcuti.nama_cuti',
            'id0.nama',
            'tgl_pengajuan',
            'tgl_mulai_cuti',
            'tgl_akhir_cuti',
//            'alasan_cuti',
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{view}',
                'buttons' => [
                    'view' => function($url, $model) {
                return Html::a('<span class="btn btn-primary btn-sm">Lihat</span>', $url, [
                            'title' => Yii::t('app', 'view'),
                            'class' => 'btn btn-primary btn-xs',
                ]);
            }
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                $url = Url::toRoute(['/siti/tpermohonan-cuti/view','id' =>$model->id_pcuti]);
                return $url;
            }
        }
            ],
        ],
    ]);
    ?>

</div>
<div class="tpermohonan-cuti-index">
    <h2>Sudah Direspon:</h2>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider1,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id_pcuti',
            //'idJcuti.nama_cuti',
            'id0.nama',
            'tgl_pengajuan',
            'tgl_mulai_cuti',
            'tgl_akhir_cuti',
//            'lama_cuti',
//            'alasan_cuti',
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{view}',
                'buttons' => [
                    'view' => function($url, $model) {
                return Html::a('<span class="btn btn-primary btn-sm">Lihat</span>', $url, [
                            'title' => Yii::t('app', 'view'),
                            'class' => 'btn btn-primary btn-xs',
                ]);
            }
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                $url = Url::toRoute(['/siti/tpermohonan-cuti/view','id' =>$model->id_pcuti]);
                return $url;
            }
        }
            ],
        ],
    ]);
    ?>

</div>
