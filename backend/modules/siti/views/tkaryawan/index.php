<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\models\TKaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Karyawan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tkaryawan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Karyawan', ['/siti/default/signup'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'nik',
            'nama',
            'email:email',
            'no_hp',
            //'inisial',
            'id_sex',
            // 'status_kawin',
            //'d_aw_kerja',
            'status_kepeg',
            //'key_sys_user',
            //'pendidikan_now',
            'id_jabatan',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
