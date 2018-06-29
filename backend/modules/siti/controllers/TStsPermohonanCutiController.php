<?php

namespace backend\modules\siti\controllers;

use Yii;
use backend\modules\siti\models\TStsPermohonanCuti;
use backend\modules\siti\models\TStsPermohonanCutiSearch;
use backend\modules\siti\models\TPermohonanCuti;
use backend\modules\siti\models\TMasterCutiIzin;
use backend\modules\siti\models\TDataCuti;
use backend\modules\siti\models\User;
use backend\modules\siti\models\TJabatan;
use backend\modules\siti\models\TKaryawan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TStsPermohonanCutiController implements the CRUD actions for TStsPermohonanCuti model.
 */
class TStsPermohonanCutiController extends Controller {

    public function behaviors() {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
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
     * Lists all TStsPermohonanCuti models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TStsPermohonanCutiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TStsPermohonanCuti model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TStsPermohonanCuti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TStsPermohonanCuti();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_status]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TStsPermohonanCuti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_status]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TStsPermohonanCuti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

//    public function actionConfirm($id) {
//        //$model=$this->loadModelToConfirm($id);
//        $model = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
//        $model3 = new TDataCuti();
//        $status = TStsPermohonanCuti::getStatusKonfirm($id);
//        $myid=  \Yii::$app->user->id;
//        $peg = User::findOne(['id' => $myid]);
//        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
//        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);
//
//        if ($status == false || $model->status == "Confirm Atasan Langsung" || $model->status == "Reject Atasan Langsung" || $model->status == "Confirm Wakil Rektor 2" || $model->status == "Reject Wakil Rektor 2" || $model->status == "Cancel") {
//            Yii::$app->session->setFlash('note','ACCESS DENIED.');
//            return $this->redirect(['/site/restriction']);
//        } else {
//            $model->status = "Confirm Atasan Langsung";
//
//            if ($model->save()) {
//
//            if($jabatan->jabatan == "Rektor"){
//            $modelpermo = TPermohonanCuti::findOne(['id_pcuti' => $id]);
//            $tglmulai = $modelpermo->tgl_mulai_cuti;
//            $tglakhir = $modelpermo->tgl_akhir_cuti;
//            $selisih = $modelpermo->selisihdate($tglmulai, $tglakhir);
//            $model2 = TMasterCutiIzin::findOne(['id_karyawan' => $modelpermo->id]);
//
//                if($modelpermo->id_jcuti==2){
//                $model2->kuota_cuti_n=$model2->kuota_cuti_n-$selisih;
//                }
//                else if($modelpermo->id_jcuti==3){
//                $model2->kuota_cuti_m=$model2->kuota_cuti_m-$selisih;
//                }
//                else if($modelpermo->id_jcuti==4){
//                $model2->kuota_cuti_k=$model2->kuota_cuti_k-$selisih;
//                }
//                else if($modelpermo->id_jcuti==5){
//                $model2->kuota_cuti_d=$model2->kuota_cuti_d-$selisih;
//                }
//                else {
//                $model2->kuota_cuti = $model2->kuota_cuti - $selisih;
//                }
//
//            if($model2->save()){
//                $model3->id_pcuti=$model->id_pcuti;
//                $model3->tgl_sah_mulai=$modelpermo->tgl_mulai_cuti;
//                $model3->tgl_sah_akhir=$modelpermo->tgl_akhir_cuti;
//                $model3->lama_sah=$selisih;
//                $model3->save();
//
//            }
//            }
//                $pesan = "Yth. Bpk Yosef Manik, Anda mendapatkan request permohonan cuti"
//                                . " Sekiranya anda dapat memberikan respon atas request tersebut."
//                                . " Silahkan akses http://localhost/siti/backend/web/index.php?r=siti%2Fdefault%2Findex";
//                $tujuan="raymondsitepu03@gmail.com";
//                //$this->Sendmail($pesan, $tujuan);
//                $this->redirect(['view', 'id' => $model->id_status]);
//            }
//        }
//    }
    public function actionConfirm($id) {

        $model = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
        $status = TStsPermohonanCuti::getStatusKonfirm($id);

        if ($status == false || $model->status == "Confirm Atasan Langsung" || $model->status == "Reject Atasan Langsung" || $model->status == "Confirm Wakil Rektor 2" || $model->status == "Reject Wakil Rektor 2" || $model->status == "Cancel") {
            Yii::$app->session->setFlash('note', 'ACCESS DENIED.');
            return $this->redirect(['/site/restriction']);
        } else {
            $model->status = "Confirm Atasan Langsung";
            if ($model->save()) {
                $modelpermo = TPermohonanCuti::findOne(['id_pcuti' => $id]);
                $notif = TKaryawan::findOne(['id' => $modelpermo->id]);
                $name = $notif->nama;
                $pesan = "Yth. Bpk Yosef Manik, Anda mendapatkan request permohonan cuti dari $name,"
                        . " Sekiranya anda dapat memberikan respon atas request tersebut."
                        . " Silahkan akses http://localhost/siti/backend/web/index.php?r=siti%2Fdefault%2Findex";
                $tujuan = "raymondsitepu03@gmail.com";
                //$this->Sendmail($pesan, $tujuan);
                $this->redirect(['view', 'id' => $model->id_status]);
            }
        }
    }

    public function Sendmail($pesan, $tujuan) {
        $email = Yii::$app->mail->compose()
                ->setFrom([\Yii::$app->params['supportEmail'] => 'siti'])
                ->setTo($tujuan)
                ->setSubject("Permohonan Cuti karyawan")
                ->setTextBody($pesan)
                ->send();
        return $email;
    }

    public function actionReject($id) {
        $model = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
        $status = TStsPermohonanCuti::getStatusKonfirm($id);
        if ($status == false || $model->status == "Confirm Atasan Langsung" || $model->status == "Reject Atasan Langsung" || $model->status == "Confirm Wakil Rektor 2" || $model->status == "Reject Wakil Rektor 2" || $model->status == "Cancel") {
            Yii::$app->session->setFlash('note', 'ACCESS DENIED.');
            return $this->redirect(['/site/restriction']);
        } else {
            $model->status = "Reject Atasan Langsung";
            if ($model->save()) {
                $this->redirect(['update','id'=>$model->id_status]);
            }
        }
    }

    public function actionConfirmwr2($id) {
        $model = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
        $model3 = new TDataCuti();
        $status = TStsPermohonanCuti::getStatusKonfirmWR2($id);
        if ($status == false || $model->status == "Confirm Wakil Rektor 2" || $model->status == "Reject Wakil Rektor 2" || $model->status == "Cancel") {
            Yii::$app->session->setFlash('note', 'ACCESS DENIED.');
            return $this->redirect(['/site/restriction']);
        } else {
            $modelpermo = TPermohonanCuti::findOne(['id_pcuti' => $id]);
            $tglmulai = $modelpermo->tgl_mulai_cuti;
            $tglakhir = $modelpermo->tgl_akhir_cuti;
            $selisih = $modelpermo->selisihdate($tglmulai, $tglakhir);
            $model->status = "Confirm Wakil Rektor 2";
            if ($model->save()) {
                $model2 = TMasterCutiIzin::findOne(['id_karyawan' => $modelpermo->id]);

                if ($modelpermo->id_jcuti == 2) {
                    $model2->kuota_cuti_n = $model2->kuota_cuti_n - $selisih;
                } else if ($modelpermo->id_jcuti == 3) {
                    $model2->kuota_cuti_m = $model2->kuota_cuti_m - $selisih;
                } else if ($modelpermo->id_jcuti == 4) {
                    $model2->kuota_cuti_k = $model2->kuota_cuti_k - $selisih;
                } else if ($modelpermo->id_jcuti == 5) {
                    $model2->kuota_cuti_d = $model2->kuota_cuti_d - $selisih;
                } else {
                    $model2->kuota_cuti = $model2->kuota_cuti - $selisih;
                }

                if ($model2->save()) {
                    $model3->id_pcuti = $model->id_pcuti;
                    $model3->lama_sah = $selisih;
                    $model3->tgl_sah_mulai = $modelpermo->tgl_mulai_cuti;
                    $model3->tgl_sah_akhir = $modelpermo->tgl_akhir_cuti;
                    $model3->save();

                    $notif = TKaryawan::findOne(['id' => $modelpermo->id]);
                    $tgl1= $modelpermo->tgl_mulai_cuti;
                    $tgl2= $modelpermo->tgl_akhir_cuti;
                    $alasan= $modelpermo->alasan_cuti;
                    $alih = $modelpermo->pengalihan;
                    $tujuan = $notif->email;
                    $name = $notif->nama;

                    $pesan = "Yth. $name, Request Cuti anda telah dikonfirmasi."
                            . "Keterangan Tanggal : $tgl1 Sampai : $tgl2,"
                            . "Alasan : $alasan, Keterangan Pengalihan Tugas : $alih."
                            . " , Silahkan akses http://localhost/siti/backend/web/index.php?r=siti%2Fdefault%2Findex";

                    //$this->Sendmail($pesan, $tujuan);
                }
                $this->redirect(['view', 'id' => $model->id_status]);
            }
        }
    }

    public function actionRejectwr2($id) {
        //$model=$this->loadModelToConfirm($id);
        $model = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
        $status = TStsPermohonanCuti::getStatusKonfirmWR2($id);
        if ($status == false || $model->status == "Confirm Wakil Rektor 2" || $model->status == "Reject Wakil Rektor 2" || $model->status == "Cancel") {
            Yii::$app->session->setFlash('note', 'ACCESS DENIED.');
            return $this->redirect(['/site/restriction']);
        } else {
            $model->status = "Reject Wakil Rektor 2";
            if ($model->save()) {
                $this->redirect(['update','id'=>$model->id_status]);
            }
        }
    }

    public function actionCancel($id) {
        //$model=$this->loadModelToConfirm($id);
        $model = TStsPermohonanCuti::findOne(['id_pcuti' => $id]);
        $status = TStsPermohonanCuti::getStatusAkhiri($id);
        if ($status == false || $model->status == "Cancel") {
            Yii::$app->session->setFlash('note', 'ACCESS DENIED.');
            return $this->redirect(['/site/restriction']);
        } else {

            $model->status = "Cancel";
            if ($model->save()) {
                Yii::$app->session->setFlash('note', 'Request telah di Cancel');
                return $this->redirect(['/siti/tpermohonan-cuti/view', 'id' => $id]);
            }
        }
    }

    /**
     * Finds the TStsPermohonanCuti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TStsPermohonanCuti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TStsPermohonanCuti::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
