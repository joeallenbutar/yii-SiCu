<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "t_permohonanizin".
 *
 * @property integer $id_pizin
 * @property integer $id
 * @property integer $id_jizin
 * @property string $tgl_pengajuan
 * @property integer $lama_izin
 * @property integer $id_atasan
 * @property string $pengalihan
 * @property string $alasan_izin
 * @property string $tgl_mulai_izin
 * @property string $tgl_akhir_izin
 *
 * @property TJabatan $idAtasan
 * @property TJenisIzin $idJizin
 * @property TKaryawan $id0
 * @property TDataIzin[] $TDataIzins
 * @property TStsPermohonanIzin[] $TStsPermohonanIzins
 */
class TPermohonanIzin extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 't_permohonanizin';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_jizin', 'tgl_mulai_izin', 'tgl_akhir_izin','alasan_izin'], 'required'],
            [['id', 'id_jizin', 'lama_izin', 'id_atasan'], 'integer'],
            [['tgl_pengajuan', 'tgl_mulai_izin', 'tgl_akhir_izin'], 'safe'],
            [['alasan_izin','pengalihan'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_pizin' => 'Id Pizin',
            'id' => 'ID',
            'id_jizin' => 'Jenis Izin',
            'tgl_pengajuan' => 'Tanggal Pengajuan',
            'lama_izin' => 'Lama Izin/Hari',
            'id_atasan' => 'Atasan',
            'pengalihan' => 'Keterangan Pengalihan Tugas (Optional)',
            'alasan_izin' => 'Alasan Izin',
            'tgl_mulai_izin' => 'Tanggal Mulai Izin',
            'tgl_akhir_izin' => 'Tanggal Akhir Izin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAtasan() {
        return $this->hasOne(TJabatan::className(), ['id_jabatan' => 'id_atasan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJizin() {
        return $this->hasOne(TJenisIzin::className(), ['id_jizin' => 'id_jizin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0() {
        return $this->hasOne(TKaryawan::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTDataIzins() {
        return $this->hasMany(TDataIzin::className(), ['id_pizin' => 'id_pizin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTStsPermohonanIzins() {
        return $this->hasMany(TStsPermohonanIzin::className(), ['id_pizin' => 'id_pizin']);
    }

    public function selisihdate($tglmulai, $tglakhir) {
        $pecah1 = explode("-", $tglmulai);
        $date1 = $pecah1[2];
        $month1 = $pecah1[1];
        $year1 = $pecah1[0]; // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun // dari tanggal kedua
        $pecah2 = explode("-", $tglakhir);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 = $pecah2[0]; // menghitung JDN dari masing-masing tanggal
        $jd1 = gregoriantojd($month1, $date1, $year1);
        $jd2 = gregoriantojd($month2, $date2, $year2);
        ////hitung selisih hari kedua tanggal
        return (int) $selisih = abs($jd2 - $jd1);
    }

    public function selisihdatenow($now, $tgl) {
        $pecah1 = explode("-", $tgl);
        $date1 = $pecah1[2];
        $month1 = $pecah1[1];
        $year1 = $pecah1[0]; // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun // dari tanggal kedua
        $pecah2 = explode("-", $now);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 = $pecah2[0]; // menghitung JDN dari masing-masing tanggal
        $jd1 = gregoriantojd($month1, $date1, $year1);
        $jd2 = gregoriantojd($month2, $date2, $year2);
        ////hitung selisih hari kedua tanggal
        return (int) $selisih = $jd2 - $jd1;
    }

//    public function ViewDateIzin() {
//        $id = Yii::$app->user->Id;
//        $now = date('Y-m-d', strtotime('0 day'));
//        $peg = User::findOne(['id' => $id]);
//        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
//        $model = TPermohonanIzin::findOne(['id' => $idkar->id]);
//
//        foreach ($model as $value) {
//            if ($value->tgl_akhir_izin > $now) {
//                return false;
//            }
//        }
//        return true;
//    }

    public function ViewDateIzin() {
        $id = Yii::$app->user->Id;
        $now = date('Y-m-d', strtotime('0 day'));
        $peg = User::findOne(['id' => $id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $model = TPermohonanIzin::find(['id' => $idkar->id])->all();

        foreach ($model as $value) {
            if ($value->tgl_akhir_izin > $now) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function ViewKuotaIzin() {
        $id = Yii::$app->user->Id;
        $peg = User::findOne(['id' => $id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $model = TMasterCutiIzin::findOne(['id_karyawan' => $idkar->id]);
        if ($model->jlh_izin <= 0 && $model->jlh_izin>=10) {
            return false;
        } else {
            return true;
        }
    }

    public function getJumlahIzin($id) {
        $id = Yii::$app->user->id;
        $peg = User::findOne(['id' => $id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);
        $count = TStsPermohonanIzin::find()
        ->where(['id_atasan'=>$idkar->id_jabatan, 'status'=>"Belum Dikonfirmasi"])->count();
        return $count;
    }

    public function getStatusAjukanUlangIzin($id_pizin) {
        //$peg = PermohonanCuti::model()->findByattributes(['id_pcuti'=> $id_pcuti]);
        $stat = TStsPermohonanIzin::findOne(['id_pizin' => $id_pizin]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findOne(['id_bawahan' => $idkar->id_jabatan]);

        if ($struk && $stat->status == "Reject Atasan Langsung") {
            return true;
        } else {
            return false;
        }
    }

}
