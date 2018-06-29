<?php

namespace backend\modules\siti\controllers;

use Yii;
use backend\modules\siti\models\TPermohonanCuti;
use backend\modules\siti\models\TPermohonanCutiSearch;
use backend\modules\siti\models\TKaryawan;
use backend\modules\siti\models\User;
use backend\modules\siti\models\TMasterCutiIzin;
use backend\modules\siti\models\TJenisCuti;
use backend\modules\siti\models\TStruktur;
use backend\modules\siti\models\TJabatan;
use backend\modules\siti\models\TStsPermohonanCuti;
use yii\web\Controller;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;

//http://localhost/siti/backend/web/index.php?r=siti%2Ftrstatus-permohonancuti%2Fconfirmwr2&id=19
/**
 * TPermohonanCutiController implements the CRUD actions for TPermohonanCuti model.
 */
class TPermohonanCutiController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update', 'delete', 'index', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TPermohonanCuti models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TPermohonanCutiSearch();

        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($jabatan->jabatan == "Wakil Rektor 2") {
            $dataProvider = $searchModel->searchWr2(Yii::$app->request->queryParams);
            $dataProvider1 = $searchModel->searchMe2(Yii::$app->user->id);
        } else if ($jabatan->jabatan == "HRD") {
            $dataProvider1 = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider = $searchModel->searchMe1(Yii::$app->user->id);
            return $this->render('indexhrd', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'dataProvider1' => $dataProvider1,
            ]);
        } else {
            $dataProvider = $searchModel->searchMe(Yii::$app->user->id);
            $dataProvider1 = $searchModel->searchMe1(Yii::$app->user->id);
        }

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
        ]);
    }

    /**
     * Displays a single TPermohonanCuti model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TPermohonanCuti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
        }

        $model = new TPermohonanCuti;
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $model2 = TMasterCutiIzin::findOne(['id_karyawan' => $idkar->id]);
        $idper = TPermohonanCuti::findOne(['id' => $idkar->id]);
        $model1 = new TStsPermohonanCuti;
        $struk = TStruktur::findOne(['id_bawahan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $struk->id_atasan]);
        $atasan = TKaryawan::findOne(['id_jabatan' => $struk->id_atasan]);

        if ($model->ViewKuotaCuti()) {
            if ($model->load(Yii::$app->request->post())) {
                $model->id = Yii::$app->user->identity->id;
                $model->id_atasan = $struk->id_atasan;

                $jeniscuti = TJenisCuti::findOne(['id_jcuti' => $model->id_jcuti]);
                $max = $jeniscuti->lama_cuti;

                $tgl1 = $model->tgl_mulai_cuti;
                $tgl2 = $model->tgl_akhir_cuti;

                $selisih = $model->selisihdate($tgl1, $tgl2);

                if ($jeniscuti->id_jcuti == 2) {
                    $sisacuti = $model2->kuota_cuti_n;
                } else if ($jeniscuti->id_jcuti == 3) {
                    $sisacuti = $model2->kuota_cuti_m;
                } else if ($jeniscuti->id_jcuti == 4) {
                    $sisacuti = $model2->kuota_cuti_k;
                } else if ($jeniscuti->id_jcuti == 5) {
                    $sisacuti = $model2->kuota_cuti_d;
                } else {
                    $sisacuti = $model2->kuota_cuti;
                }

                $model->lama_cuti = $selisih;

                $now = date('Y-m-d', strtotime('0 day'));
                $cek1 = $model->selisihdate($now, $tgl1);
                $cek2 = $model->selisihdate($now, $tgl2);

                $cekdatenow = $model->selisihdatenow($now, $tgl1);
                $cekdatehari = $model->selisihdatenow($tgl2, $tgl1);

                if ($cekdatenow > 0) {
                    //jika tanggal mulai tgl1 memiliki selisih >0 n=maka tidak dapat melakukan cuti
                    // $message = "<CENTER>Gagal Melakukan Cuti!<BR>Tanggal Mulai lebih kecil dari Tanggal Sekarang</CENTER>";
                    Yii::$app->session->setFlash('note', 'Tanggal Mulai tidak boleh lebih kecil dari Tanggal Sekarang');
                    return $this->redirect(['/site/warning']);
                } else if ($cek1 > $cek2 || $cek1 == $cek2) {
                    //jika tanggal mulai cek1 lebih besar dari tanggal akhir cek2
                    //$message = "<CENTER>Gagal Melakukan Izin!<BR>Tanggal Mulai lebih besar dari Tanggal Akhir</CENTER>";
                    Yii::$app->session->setFlash('note', 'Tanggal Mulai tidak boleh lebih besar dari Tanggal Akhir');
                    return $this->redirect(['/site/warning']);
                } else if ($cek1 < 21) {
                    //jika tanggal mulai cek1 lebih besar dari tanggal akhir cek2
                    //$message = "<CENTER>Gagal Melakukan Izin!<BR>Tanggal Mulai lebih besar dari Tanggal Akhir</CENTER>";
                    Yii::$app->session->setFlash('note', 'Cuti Harus dilakukan 3 minggu sebelum hari H');
                    return $this->redirect(['/site/warning']);
                } else if ($selisih > $sisacuti) {
                    //jika jumlah hari permohonan cuti melebihi sisa kuota cuti
                    //$message = "<CENTER>Gagal Melakukan Cuti!</CENTER>";
                    Yii::$app->session->setFlash('note', 'Kuota tidak mencukupi.');
                    return $this->redirect(['/site/warning']);
                } else if ($selisih > $max) {
                    //jika jumlah hari permohonan cuti melebihi batas maksimal cuti
                    //$message = "<CENTER>Gagal Melakukan Cuti!</CENTER>";
                    Yii::$app->session->setFlash('note', 'Jumlah hari permohonan cuti melebihi batas maksimal cuti');
                    return $this->redirect(['/site/warning']);
                } else {
                    if ($model->save()) {
                        $model1->id_pcuti = $model->id_pcuti;
                        $model1->jlh_permohonan++;
                        $model1->id_atasan = $model->id_atasan;
                        $model1->keterangan = $model->alasan_cuti;
                        $model1->status = "Belum Dikonfirmasi";

                        //email
                        $name = $atasan->nama;
                        $pemohon = $idkar->nama;
                        $als = $model->alasan_cuti;
                        $tujuan = $atasan->email;
                        $pesan = "Yth. $name, Anda mendapatkan request permohonan cuti dari $pemohon, dengan alasan : $als\n"
                                . " Sekiranya anda dapat memberikan respon atas request tersebut."
                                . " Silahkan akses http://localhost/siti/backend/web/index.php?r=siti%2Fdefault%2Findex";

//                        $cekkoneksi=  connection_status();
//                        if($this->Sendmail($pesan, $tujuan)){
//                        $model1->save();
//                        //Sukses Melakukan Cuti
//                        Yii::$app->session->setFlash('note', 'Sukses merequest cuti.');
//                        return $this->redirect(['view', 'id' => $model->id_pcuti]);
//                        }
//                        else{
//                        $model1->save();
//                        Yii::$app->session->setFlash('note', 'Email tidak dapat dikirim dikarenekan masalah koneksii.');
//                        return $this->redirect(['view', 'id' => $model->id_pcuti]);
//                        }
                        $model1->save();
                        Yii::$app->session->setFlash('note', 'Sukses merequest cuti.');
                        return $this->redirect(['view', 'id' => $model->id_pcuti]);
                    }
                }
            }
        } else {
            //$message = "<CENTER>Gagal Melakukan Cuti!<BR>Kuota Cuti tidak mencukupi</CENTER>";
            Yii::$app->session->setFlash('note', 'Kuota tidak mencukupi');
            return $this->redirect(['/site/warning']);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function Sendmail($pesan, $tujuan) {
        $email = Yii::$app->mail->compose()
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Sistem Cuti'])
                ->setTo($tujuan)
                ->setSubject("Permohonan Cuti karyawan")
                ->setTextBody($pesan)
                ->send();
        return $email;
    }

    public function actionIndexhrd() {

        $searchModel = new TPermohonanCutiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('indexhrd', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCetak($id) {
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $model = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($model->status == "Confirm Atasan Langsung" && ($jabatan->jabatan == "Wakil Rektor 1" || $jabatan->jabatan == "Wakil Rektor 2" || $jabatan->jabatan == "Wakil Rektor 3" || $jabatan->jabatan == "Rektor")) {
            $pdf = new \mPDF;
            $permohonan = TPermohonanCuti::findBySql("SELECT * from t_permohonancuti WHERE id_pcuti= " . $id . "")->all();
            $status = TStsPermohonanCuti::findBySql("SELECT * from t_sts_permohonancuti  WHERE id_pcuti= " . $id . "")->all();
            $pdf->SetTitle('Permohonan Cuti');
            $html = $this->renderPartial('cetak', ['PermohonanCuti' => $this->findModel($id)], TRUE);
            $pdf->WriteHTML($html);
            $pdf->Output();
            exit;
        } else if ($jabatan->jabatan == "HRD" && $model->status == "Confirm Atasan Langsung" || $model->status == "Confirm Wakil Rektor 2") {
            $pdf = new \mPDF;
            $permohonan = TPermohonanCuti::findBySql("SELECT * from t_permohonancuti WHERE id_pcuti= " . $id . "")->all();
            $status = TStsPermohonanCuti::findBySql("SELECT * from t_sts_permohonancuti  WHERE id_pcuti= " . $id . "")->all();
            $pdf->SetTitle('Permohonan Cuti');
            $html = $this->renderPartial('cetak', ['PermohonanCuti' => $this->findModel($id)], TRUE);
            $pdf->WriteHTML($html);
            $pdf->Output();
            exit;
        } else if ($model->status != "Confirm Wakil Rektor 2" || $jabatan->jabatan != "Wakil Rektor 1" || $jabatan->jabatan != "Wakil Rektor 2" || $jabatan->jabatan != "Wakil Rektor 3" || $jabatan->jabatan != "Rektor") {
            return $this->redirect(['/site/restriction']);
        } else {
            $pdf = new \mPDF;
            $permohonan = TPermohonanCuti::findBySql("SELECT * from t_permohonancuti WHERE id_pcuti= " . $id . "")->all();
            $status = TStsPermohonanCuti::findBySql("SELECT * from t_sts_permohonancuti  WHERE id_pcuti= " . $id . "")->all();
            $pdf->SetTitle('Permohonan Cuti');
            $html = $this->renderPartial('cetak', ['PermohonanCuti' => $this->findModel($id)], TRUE);
            $pdf->WriteHTML($html);
            $pdf->Output();
            exit;
        }
    }

    /**
     * Updates an existing TPermohonanCuti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
        }

        $model = $this->findModel($id);

        $stat = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
        if ($stat->status != "Belum Dikonfirmasi") {
            Yii::$app->session->setFlash('note', 'Tidak dapat dirubah, Request telah direspon.');
            $this->redirect(['lihatriwayat']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pcuti]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TPermohonanCuti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLihatriwayat() {
        $searchModel = new TPermohonanCutiSearch();
        $dataProvider = $searchModel->searchByUser(Yii::$app->user->id);
        return $this->render('lihatriwayat', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the TPermohonanCuti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TPermohonanCuti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TPermohonanCuti::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function loadModelstatus($id) {
        $model = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
        if ($model === null)
            throw new NotFoundHttpException('The requested page does not exist.');
        return $model;
    }

}

//    public function actionBios() {
//        $bios = new TStsPermohonanCuti;
//        $cuti = new TPermohonanCuti;
//        $cuti = TPermohonanCuti::findBySql('select distinct nama, j.jabatan,c.alasan_cuti,s.status from user u join t_m_karyawan p on u.nik=p.nik join t_r_jabatan j on p.id_jabatan=j.id_jabatan join t_permohonan_cuti c on j.id_jabatan=c.id_atasan join t_r_status_permohonancuti s on c.id_atasan=s.id_atasan where u.nik=11113060 and s.status like "Belum Dikonfirmasi"')->all();
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $cuti,
//        ]);
//
//        return $this->render('bios', [
//                    'dataProvider' => $dataProvider,
//        ]);
//    }
