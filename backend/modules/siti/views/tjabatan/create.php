<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TJabatan */

$this->title = 'Create Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'TJabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tjabatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
