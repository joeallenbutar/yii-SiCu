<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\siti\models\TStrukturSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Struktur';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstruktur-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Struktur', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_struktur',
            ['attribute'=>'Atasan',
             'value'=>'idAtasan.jabatan'],
            ['attribute'=>'Bawahan',
             'value'=>'idBawahan.jabatan'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
