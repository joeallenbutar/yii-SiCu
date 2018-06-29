<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TDataCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdata-cuti-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data Cuti', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cuti',
            'id_pcuti',
            'tgl_sah',
            'lama_sah',
            'tgl_sah_mulai',
            // 'tgl_sah_akhir',
            // 'catatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
