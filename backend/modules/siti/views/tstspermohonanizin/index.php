<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TStsPermohonanIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Permohonan Izin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trstspermohonanizin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_status',
//            'id_pizin',
//            'jlh_permohonan',
            'idAtasan.jabatan',
            //'keterangan',
            'status',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
