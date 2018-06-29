<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TJenisIzin */

$this->title = 'Update Trjenis Izin: ' . ' ' . $model->id_jizin;
$this->params['breadcrumbs'][] = ['label' => 'Trjenis Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jizin, 'url' => ['view', 'id' => $model->id_jizin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trjenis-izin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
