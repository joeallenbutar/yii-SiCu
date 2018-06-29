<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStsPermohonanIzin */

$this->title = 'Create Trstatus Permohonanizin';
$this->params['breadcrumbs'][] = ['label' => 'Trstatus Permohonanizins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trstspermohonanizin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
