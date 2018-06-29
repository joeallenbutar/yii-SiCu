<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TJenisIzin */

$this->title = 'Create Trjenis Izin';
$this->params['breadcrumbs'][] = ['label' => 'Trjenis Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trjenis-izin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
