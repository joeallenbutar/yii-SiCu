<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TDataIzin */

$this->title = 'Update Trdata Izin: ' . ' ' . $model->id_izin;
$this->params['breadcrumbs'][] = ['label' => 'Trdata Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_izin, 'url' => ['view', 'id' => $model->id_izin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tdata-izin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
