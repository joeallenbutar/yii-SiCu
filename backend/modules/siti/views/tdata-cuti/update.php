<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TDataCuti */

$this->title = 'Ubah Data Cuti: ' . ' ' . $model->id_cuti;
$this->params['breadcrumbs'][] = ['label' => 'Data Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cuti, 'url' => ['view', 'id' => $model->id_cuti]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tdata-cuti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
