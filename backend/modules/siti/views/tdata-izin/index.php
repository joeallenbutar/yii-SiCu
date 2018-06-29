<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TDataIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trdata Izins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdata-izin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trdata Izin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_izin',
            'id_pizin',
            'tgl_sah',
            'lama_sah',
            'tgl_sah_mulai',
            // 'tgl_sah_akhir',
            // 'catatan',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
