<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TMasterCutiIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmaster-cutiizin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPegawai.nama',
            'kuota_cuti',
            'kuota_cuti_n',
            'kuota_cuti_m',
            'kuota_cuti_k',
            'kuota_cuti_d',
            'jlh_izin',
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{update}',
                'buttons' => [
                    'view' => function($url, $model) {
                return Html::a('<span class="btn btn-primary btn-sm">Update</span>', $url, [
                            'title' => Yii::t('app', 'update'),
                            'class' => 'btn btn-primary btn-xs',
                ]);
            }
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'update') {
                $url = Url::toRoute(['/siti/trdetail-cuti/update','id' =>$model->id]);
                return $url;
            }
        }
            ],
        ],
    ]); ?>

</div>
