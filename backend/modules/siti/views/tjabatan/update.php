<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TJabatan */

$this->title = 'Update TJabatan: ' . ' ' . $model->id_jabatan;
$this->params['breadcrumbs'][] = ['label' => 'TJabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jabatan, 'url' => ['view', 'id' => $model->id_jabatan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tjabatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
