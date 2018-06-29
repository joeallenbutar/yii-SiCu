<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\TKaryawan */

$this->title = 'Create TKaryawan';
$this->params['breadcrumbs'][] = ['label' => 'TKaryawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="TKaryawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
