<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStsPermohonanIzin */

//$this->title = Yii::$app->user->id;
$this->params['breadcrumbs'][] = ['label' => 'Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trstspermohonanizin-view">

    <h1><?= Html::encode($this->title) ?></h1>

  <h3>Berhasil Merespon Request Izin :</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_status',
            //'id_pcuti',
            //'jlh_permohonan',
            'idAtasan.jabatan',
            'keterangan',
            'status',
            'alasan_reject',
        ],
    ]) ?>
    <br>
    <p><a class="btn btn-lg btn-success" href="http://localhost/siti/backend/web/index.php?r=siti%2Fdefault%2Findex" target="_parent">Back to Home</a></p>

</div>
