<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TMasterCutiIzin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trdetail Cutis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmaster-cutiizin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'kuota_cuti',
            'kuota_cuti_n',
            'kuota_cuti_m',
            'kuota_cuti_k',
            'kuota_cuti-d',
            ],
    ]) ?>

</div>
