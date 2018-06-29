<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TStsPermohonanCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Permohonan Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstspermohonancuti-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_status',
//            'id_pcuti',
//            'jlh_permohonan',
            'idAtasan.jabatan',
            //'keterangan',
            'status',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'deleted',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
