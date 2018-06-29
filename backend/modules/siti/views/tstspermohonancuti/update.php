    <?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\siti\models\TStsPermohonanCuti */
?>
<div class="tstspermohonancuti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formalasan', [
        'model' => $model,
    ]) ?>

</div>
