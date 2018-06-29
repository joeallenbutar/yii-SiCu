<?php

namespace backend\modules\siti\controllers;

use Yii;
use backend\modules\siti\models\TStsPermohonanIzin;
use backend\modules\siti\models\TPermohonanIzin;
use backend\modules\siti\models\TMasterCutiIzin;
use backend\modules\siti\models\TStsPermohonanIzinSearch;
use backend\modules\siti\models\TDataIzin;
use backend\modules\siti\models\TKaryawan;
use backend\modules\siti\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TStsPermohonanIzinController implements the CRUD actions for TStsPermohonanIzin model.
 */
class TStsPermohonanIzinController extends Controller {

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
     * Lists all TStsPermohonanIzin models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TStsPermohonanIzinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TStsPermohonanIzin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TStsPermohonanIzin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TStsPermohonanIzin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_status]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TStsPermohonanIzin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
//
//        if($model->id_atasan!=$idkar->id_jabatan){
//            return $this->redirect(['/site/restrictions']);
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_status]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TStsPermohonanIzin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TStsPermohonanIzin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TStsPermohonanIzin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TStsPermohonanIzin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionConfirm($id) {
        $model = TStsPermohonanIzin::findOne(['id_pizin' => $id]);
        $model3 = new TDataIzin();
        $modelpermo = TPermohonanIzin::findOne(['id_pizin' => $id]);
        $tglmulai = $modelpermo->tgl_mulai_izin;
        $tglakhir = $modelpermo->tgl_akhir_izin;
        $selisih = $modelpermo->selisihdate($tglmulai, $tglakhir);
        $status = TStsPermohonanIzin::getStatusKonfirm($id);
        if ($status == false || $model->status == "Confirm Atasan Langsung" || $model->status == "Reject Atasan Langsung" || $model->status == "Confirm Wakil Rektor 2" || $model->status == "Reject Wakil Rektor 2" || $model->status == "Cancel") {
            return $this->redirect(['/site/restrictions']);
        } else {
            $model->status = "Confirm Atasan Langsung";
            if ($model->save()) {
                $model2 = TMasterCutiIzin::findOne(['id_karyawan' => $modelpermo->id]);
                $model2->jlh_izin = $model2->jlh_izin - $selisih;
                if ($model2->save()) {
                    $model3->id_pizin = $model->id_pizin;
                    $model3->tgl_sah_mulai = $modelpermo->tgl_mulai_izin;
                    $model3->tgl_sah_akhir = $modelpermo->tgl_akhir_izin;
                    $model3->lama_sah = $selisih;
                    $model3->save();

                    $notif = TKaryawan::findOne(['id' => $modelpermo->id]);
                    $tgl1= $modelpermo->tgl_mulai_izin;
                    $tgl2= $modelpermo->tgl_akhir_izin;
                    $alasan= $modelpermo->alasan_izin;
                    $alih = $modelpermo->pengalihan;
                    $tujuan = $notif->email;
                    $name = $notif->nama;

                    $pesan = "Yth. $name, Request Izin anda telah dikonfirmasi."
                            . "Keterangan Tanggal : $tgl1 Sampai : $tgl2,"
                            . "Alasan : $alasan, Keterangan Pengalihan Tugas : $alih."
                            . " , Silahkan akses http://localhost/siti/backend/web/index.php?r=siti%2Fdefault%2Findex";

                    //$this->Sendmail($pesan, $tujuan);
                }
                $this->redirect(array('view', 'id' => $model->id_status));
            }
        }
    }

    public function actionReject($id) {
        $model = TStsPermohonanIzin::findOne(['id_pizin' => $id]);
        $status = TStsPermohonanIzin::getStatusKonfirm($id);
        if ($status == false || $model->status == "Confirm Atasan Langsung" || $model->status == "Reject Atasan Langsung" || $model->status == "Confirm Wakil Rektor 2" || $model->status == "Reject Wakil Rektor 2" || $model->status == "Cancel") {
            return $this->redirect(['/site/restrictions']);
        } else {
            $model->status = "Reject Atasan Langsung";
            if ($model->save()) {
                $this->redirect(['update','id'=>$model->id_status]);
            }
        }
    }

    public function actionCancel($id) {
        $model = TStsPermohonanIzin::findOne(['id_pizin' => $id]);
        $status = TStsPermohonanIzin::getStatusAkhiri($id);
        if ($status == false || $model->status == "Cancel") {
            return $this->redirect(['/site/restriction']);
        } else {

            $model->status = "Cancel";
            if ($model->save()) {
                Yii::$app->session->setFlash('note', 'Request telah di Cancel');
                return $this->redirect(['/siti/tpermohonan-izin/view', 'id' => $id]);
            }
        }
    }

}
