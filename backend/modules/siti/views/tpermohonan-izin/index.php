<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\modules\siti\models\TPermohonanIzin;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TPermohonanIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Izin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpermohonan-izin-index">

    <h2>Belum Direspon:</h2>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id_pizin',
            //'idJizin.nama_izin',
            'id0.nama',
            'tgl_pengajuan',
            'tgl_mulai_izin',
            'tgl_akhir_izin',
//            'lama_izin',
//            'alasan_izin',
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
                $url = Url::toRoute(['/siti/tpermohonan-izin/view','id' =>$model->id_pizin]);
                return $url;
            }
        }
            ],
        ],
    ]);
    ?>

</div>
<div class="tpermohonan-izin-index">

    <h2>Sudah Direspon:</h2>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider1,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id_pizin',
            //'idJizin.nama_izin',
            'id0.nama',
            'tgl_pengajuan',
            'tgl_mulai_izin',
            'tgl_akhir_izin',
//            'lama_izin',
//            'alasan_izin',
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
                $url = Url::toRoute(['/siti/tpermohonan-izin/view','id' =>$model->id_pizin]);
                return $url;
            }
        }
            ],
        ],
    ]);
    ?>

</div>
