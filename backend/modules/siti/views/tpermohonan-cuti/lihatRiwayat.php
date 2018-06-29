<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TPermohonanCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpermohonan-cuti-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if (Yii::$app->session->hasFlash('note')):
        ?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('note'); ?>
        </div>
        <?php
    endif;
    ?>

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
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eyes-open"></span>', $url, [
                            'title' => Yii::t('app', 'view'),
                ]);
            }
                ],

                'buttons' => [
                    'update' => function($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-chevron-right"></span>', $url, [
                            'title' => Yii::t('app', 'update'),
                ]);
            }
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                $url = Url::toRoute(['/siti/tpermohonan-cuti/view', 'id' => $model->id_pcuti]);
                return $url;
            }
            if ($action === 'update') {
                $url = Url::toRoute(['/siti/tpermohonan-cuti/update', 'id' => $model->id_pcuti]);
                return $url;
            }
        }
            ],
        ],
    ]);
    ?>

</div>
