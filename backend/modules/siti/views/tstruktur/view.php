<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStruktur */

$this->title = $model->id_struktur;
$this->params['breadcrumbs'][] = ['label' => 'Struktur', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstruktur-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_struktur], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_struktur], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_struktur',
            'idAtasan.jabatan',
            'idBawahan.jabatan',
        ],
    ]) ?>

</div>
