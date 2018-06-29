<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TPermohonanIzin */

$this->title = 'Request Izin';
// $this->params['breadcrumbs'][] = ['label' => 'Permohonan Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpermohonan-izin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
