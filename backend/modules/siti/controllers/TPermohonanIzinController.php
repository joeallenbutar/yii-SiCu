<?php

namespace backend\modules\siti\controllers;

use Yii;
use backend\modules\siti\models\TPermohonanIzin;
use backend\modules\siti\models\TPermohonanIzinSearch;
use backend\modules\siti\models\User;
use backend\modules\siti\models\TKaryawan;
use backend\modules\siti\models\TMasterCutiIzin;
use backend\modules\siti\models\TJenisIzin;
use backend\modules\siti\models\TStruktur;
use backend\modules\siti\models\TJabatan;
use backend\modules\siti\models\TStsPermohonanIzin;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;

/**
 * TPermohonanIzinController implements the CRUD actions for TPermohonanIzin model.
 */
class TPermohonanIzinController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'delete', 'view'],
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
     * Lists all TPermohonanIzin models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TPermohonanIzinSearch();

        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findOne(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($jabatan->jabatan == "HRD") {
            $dataProvider1 = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider = $searchModel->searchMe(Yii::$app->user->id);
            return $this->render('indexhrd', [
                        'searchModel' => $searchModel,
                        'dataProvider1' => $dataProvider1,
                        'dataProvider' => $dataProvider,]);
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
     * Displays a single TPermohonanIzin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TPermohonanIzin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
        }
        $model = new TPermohonanIzin;
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $model2 = TMasterCutiIzin::findOne(['id_karyawan' => $idkar->id]);
        $idper = TPermohonanIzin::findOne(['id' => $idkar->id]);
        $model1 = new TStsPermohonanIzin;
        $struk = TStruktur::findOne(['id_bawahan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $struk->id_atasan]);
        $atasan = TKaryawan::findOne(['id_jabatan' => $struk->id_atasan]);

        if ($model->ViewKuotaIzin()) {
            if ($model->load(Yii::$app->request->post())) {

                $model->id = Yii::$app->user->identity->id;
                $model->id_atasan = $struk->id_atasan;

                $jenisizin = TJenisIzin::findOne(['id_jizin' => $model->id_jizin]);
                $max = $jenisizin->lama_izin;

                $tgl1 = $model->tgl_mulai_izin;
                $tgl2 = $model->tgl_akhir_izin;

                $selisih = $model->selisihdate($tgl1, $tgl2);
                $sisaizin = $model2->jlh_izin;

                $model->lama_izin = $selisih;

                $now = date('Y-m-d', strtotime('0 day'));
                $cek1 = $model->selisihdate($now, $tgl1);
                $cek2 = $model->selisihdate($now, $tgl2);

                $cekdatenow = $model->selisihdatenow($now, $tgl1);
                $cekdatehari = $model->selisihdatenow($tgl2, $tgl1);

                if ($cekdatenow > 0) {
                    //jika tanggal mulai tgl1 memiliki selisih >0 n=maka tidak dapat melakukan cuti
                    //$message = "<CENTER>Gagal Melakukan Cuti!<BR>Tanggal Mulai lebih kecil dari Tanggal Sekarang</CENTER>";
                    Yii::$app->session->setFlash('note', 'Tanggal Mulai tidak boleh lebih kecil dari Tanggal Sekarang');
                    return $this->redirect(['/site/warnings']);
                } else if ($cek1 > $cek2 || $cek1 == $cek2) {
                    //jika tanggal mulai cek1 lebih besar dari tanggal akhir cek2
                    //$message = "<CENTER>Gagal Melakukan Izin!<BR>Tanggal Mulai lebih besar dari Tanggal Akhir</CENTER>";
                    Yii::$app->session->setFlash('note', 'Tanggal Mulai tidak boleh lebih besar dari Tanggal Akhir');
                    return $this->redirect(['/site/warnings']);
                } else if ($selisih > $sisaizin) {
                    //jika jumlah hari permohonan cuti melebihi sisa kuota cuti
                    //$message = "<CENTER>Gagal Melakukan Cuti!</CENTER>";
                    Yii::$app->session->setFlash('note', 'Kuota tidak mencukupi.');
                    return $this->redirect(['/site/warnings']);
                } else if ($selisih > $max) {
                    //jika jumlah hari permohonan cuti melebihi batas maksimal cuti
                    //$message = "<CENTER>Gagal Melakukan Cuti!</CENTER>";
                    Yii::$app->session->setFlash('note', 'Jumlah hari permohonan cuti melebihi batas maksimal cuti');
                    return $this->redirect(['/site/warnings']);
                } else {
                    if ($model->save()) {
                        $model1->id_pizin = $model->id_pizin;
                        $model1->status = "Belum Dikonfirmasi";
                        $model1->id_atasan = $model->id_atasan;
                        //$model1->id_atasan = $struk->id_atasan;
                        $model->tgl_pengajuan = date("Y-m-d");
                        $model1->jlh_permohonan++;
                        $model1->keterangan = $model->alasan_izin;

                        //email
                        $name = $atasan->nama;
                        $pemohon = $idkar->nama;
                        $als = $model->alasan_izin;
                        $tujuan = $atasan->email;
                        $pesan = "Yth. $name, Anda mendapatkan request permohonan izin dari $pemohon, dengan alasan : $als\n"
                                . " Sekiranya anda dapat memberikan respon atas request tersebut."
                                . " Silahkan akses http://localhost/siti/backend/web/index.php?r=siti%2Fdefault%2Findex";


//                        if($this->Sendmail($pesan, $tujuan)){
//                        $model1->save();
//
//                        //Sukses Melakukan Izin
//                        Yii::$app->session->setFlash('note', 'Sukses merequest izin.');
//                        return $this->redirect(['view', 'id' => $model->id_pizin]);
//                        }
//                        else{
//                        return $this->redirect(['/site/warning']);}

                        $model1->save();

                        //$message = "<CENTER>Sukses Melakukan Izin!</CENTER>";
                        Yii::$app->session->setFlash('note', 'Sukses merequest izin.');
                        return $this->redirect(['view', 'id' => $model->id_pizin]);
                    }
                }
            }
        } else {
            //$message = "<CENTER>Gagal Melakukan Cuti!<BR>Kuota Cuti tidak mencukupi</CENTER>";
           Yii::$app->session->setFlash('note', 'Kuota tidak mencukupi');
           return $this->redirect(['/site/warnings']);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function Sendmail($pesan, $tujuan) {
        $email = Yii::$app->mail->compose()
                ->setFrom([\Yii::$app->params['supportEmail'] => 'siti'])
                ->setTo($tujuan)
                ->setSubject("Permohonan Izin karyawan")
                ->setTextBody($pesan)
                ->send();
        return $email;
    }

    /**
     * Updates an existing TPermohonanIzin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
        }

        $model = $this->findModel($id);

        $stat = TStsPermohonanIzin::findOne(['id_pizin' => $id]);
        if ($stat->status != "Belum Dikonfirmasi") {
            Yii::$app->session->setFlash('note', 'Tidak dapat dirubah, Request telah direspon.');
            $this->redirect(['lihatriwayat']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pizin]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLihatriwayat() {
        $searchModel = new TPermohonanIzinSearch();
        $dataProvider = $searchModel->searchByUser(Yii::$app->user->id);

        return $this->render('lihatRiwayat', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing TPermohonanIzin model.
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

    public function actionCetak($id) {
        $model = TStsPermohonanIzin::findOne(['id_pizin' => $id]);

        if ($model->status != "Confirm Atasan Langsung") {
            return $this->redirect(['/site/restriction']);
        }
        $pdf = new \mPDF;
        $permohonan = TPermohonanIzin::findBySql("SELECT * from t_permohonanizin WHERE id_pizin= " . $id . "")->all();
        $status = TStsPermohonanIzin::findBySql("SELECT * from t_sts_permohonanizin  WHERE id_pizin= " . $id . "")->all();
        $pdf->SetTitle('Permohonan Izin');
        $html = $this->renderPartial('cetak', ['PermohonanIzin' => $this->findModel($id)], TRUE);
        $pdf->WriteHTML($html);
        $pdf->Output();
        exit;
    }

    /**
     * Finds the TPermohonanIzin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TPermohonanIzin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TPermohonanIzin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function loadModelstatus($id) {
        $model = TStsPermohonanIzin::findOne(['id_pizin' => $id]);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
