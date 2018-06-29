<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStsPermohonanCuti */

$this->title = 'Create Status Permohonancuti';
$this->params['breadcrumbs'][] = ['label' => 'Trstatus Permohonancutis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstspermohonancuti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
