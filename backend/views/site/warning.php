

<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;
use yii\web\UrlManager;

/* @var $this yii\web\View */

$this->title = 'Sistem Cuti Karyawan';
?>

<?php
    if (Yii::$app->session->hasFlash('note')):
        ?>
        <div class="alert alert-danger">
            <?php echo Yii::$app->session->getFlash('note'); ?>
        </div>
        <?php
    endif;
    ?>

<div class="site-index">

    <div class="jumbotron">

      <h3>Terjadi Kesalahan, Request Anda tidak dapat dilakukan :</h3>
<!--      <p>- Request cuti 2 minggu sebelum hari H</p>
      <p>- Periksa tanggal mulai dan akhir C4uti</p>
      <p>- Kuota anda tidak mencukupi</p>-->
      <p>---------------------------------------------------------</p>
      <p><a class="btn btn-lg btn-success" href="http://localhost/siti/backend/web/index.php?r=siti%2Ftpermohonan-cuti%2Fcreate" target="_parent">Request Kembali</a></p>


    </div>
</div>
