<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TJenisCuti */

$this->title = 'Update Trjenis Cuti: ' . ' ' . $model->id_jcuti;
$this->params['breadcrumbs'][] = ['label' => 'Trjenis Cutis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jcuti, 'url' => ['view', 'id' => $model->id_jcuti]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tjenis-cuti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
