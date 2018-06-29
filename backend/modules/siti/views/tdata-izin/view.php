<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TDataIzin */

$this->title = $model->id_izin;
$this->params['breadcrumbs'][] = ['label' => 'Trdata Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdata-izin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_izin], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_izin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_izin',
            'id_pizin',
            'tgl_sah',
            'lama_sah',
            'tgl_sah_mulai',
            'tgl_sah_akhir',
            'catatan',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted',
        ],
    ]) ?>

</div>
