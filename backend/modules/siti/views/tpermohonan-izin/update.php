<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanIzin */

$this->title = 'Update Tpermohonan Izin: ' . ' ' . $model->id_pizin;
$this->params['breadcrumbs'][] = ['label' => 'Tpermohonan Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pizin, 'url' => ['view', 'id' => $model->id_pizin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tpermohonan-izin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
