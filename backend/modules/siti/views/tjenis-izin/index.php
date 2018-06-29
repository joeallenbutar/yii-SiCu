<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TJenisIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis Izin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trjenis-izin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!--<?= Html::a('Create Trjenis Izin', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_jizin',
            'nama_izin',
            'lama_izin',
            'keterangan',
            //'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'deleted',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
