<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      .header img{
        margin-left: 10px;
        float: left;
        width: 70px;
        height: 70px;
      }
      .header h1{
        font-size: 25px;
        position: relative;
        top: 20px;
        left: 10px;
      }
    </style>
    <?= Html::csrfMetaTags() ?>
    <title>Sistem Cuti Karyawan</title>
    <?php $this->head() ?>
</head>
<div class="header">
    <img src="../views/layouts/logodel.png" alt="logo" />
    <h1>Sistem Cuti Karyawan</h1><br><hr>
</div>
<body>
<?php $this->beginBody() ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
