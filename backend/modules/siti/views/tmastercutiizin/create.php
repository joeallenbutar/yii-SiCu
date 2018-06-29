<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TMasterCutiIzin */

$this->title = 'Update Detail Cuti/Izin Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Detail Cuti/Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmaster-cutiizin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
