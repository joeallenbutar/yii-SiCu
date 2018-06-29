<?php

use backend\modules\spkp\models\TKaryawan;
use backend\modules\spkp\models\User;
use backend\modules\spkp\models\TMasterCutiIzin;
use backend\modules\spkp\models\TPermohonanCuti;
use backend\modules\spkp\models\TPermohonanIzin;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Carousel;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Sistem Cuti Karyawan';
?>

 <?php if (Yii::$app->user->id == 4) {
    ?>
    <div class="site-index">
      <div class="body-content">
          <h1>Selamat Datang di Sistem Cuti Karyawan
          <img src="eh.jpg">
      </div>
    </div>
 <?php

 }else if (Yii::$app->user->isGuest) {
    ?>
    <div class="site-index">
      <div class="body-content">
          <h1>Selamat Datang di Sistem Cuti Karyawan
          <img src="eh.jpg">
      </div>
    </div>


    <?php

    }else if(!Yii::$app->user->isGuest){?>
        <div class="site-index">
          <div class="body-content">
              <h1>Selamat Datang di Sistem Cuti Karyawan
              <img src="eh.jpg">
          </div>
        </div>
    <?php
}?>
