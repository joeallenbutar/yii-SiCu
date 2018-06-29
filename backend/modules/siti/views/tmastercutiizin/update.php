<?php

use yii\helpers\Html;
use backend\modules\siti\models\TKaryawan;
/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TMasterCutiIzin */
$nama = TKaryawan::findOne(['id'=>$model->id_karyawan]);
$this->title = 'Update Detail : ' . $nama->nama;
$this->params['breadcrumbs'][] = ['label' => 'Update Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tmaster-cutiizin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
