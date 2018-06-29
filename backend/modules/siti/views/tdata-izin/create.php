<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TDataIzin */

$this->title = 'Create Trdata Izin';
$this->params['breadcrumbs'][] = ['label' => 'Trdata Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdata-izin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
