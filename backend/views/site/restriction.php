<?php
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
      <h3>Anda tidak dapat melakukan aksi tersebut</h3>
      <p>---------------------------------------------------------</p>
      <p><a class="btn btn-lg btn-danger" href="http://localhost/siti/backend/web/index.php?r=siti%2Fdefault%2Findex" target="_parent">Home</a>
      <a class="btn btn-lg btn-success" href="http://localhost/siti/backend/web/index.php?r=siti%2Ftpermohonan-cuti" target="_parent">Back</a></p>

    </div>
</div>
