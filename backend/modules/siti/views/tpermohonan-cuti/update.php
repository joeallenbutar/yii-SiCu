<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanCuti */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Tpermohonan Cutis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pcuti, 'url' => ['view', 'id' => $model->id_pcuti]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tpermohonan-cuti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
