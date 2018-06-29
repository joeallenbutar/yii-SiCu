<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStruktur */

$this->title = 'Update TStruktur: ' . ' ' . $model->id_struktur;
$this->params['breadcrumbs'][] = ['label' => 'TStrukturs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_struktur, 'url' => ['view', 'id' => $model->id_struktur]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tstruktur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
