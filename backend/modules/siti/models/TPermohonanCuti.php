<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "t_permohonancuti".
 *
 * @property integer $id_pcuti
 * @property integer $id
 * @property integer $id_jcuti
 * @property string $tgl_pengajuan
 * @property string $tgl_mulai_cuti
 * @property string $tgl_akhir_cuti
 * @property integer $lama_cuti
 * @property string $pengalihan
 * @property string $alasan_cuti
 * @property integer $id_atasan
 *
 * @property TJenisCuti $idJcuti
 * @property TKaryawan $id0
 * @property TJabatan $idAtasan
 * @property TDataCuti[] $TDataCutis
 * @property TStsPermohonanCuti[] $TStsPermohonanCutis
 */
class TPermohonanCuti extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 't_permohonancuti';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_jcuti', 'tgl_mulai_cuti', 'tgl_akhir_cuti', 'alasan_cuti'], 'required'],
            [['id', 'id_jcuti', 'lama_cuti', 'id_atasan'], 'integer'],
            [['tgl_pengajuan', 'tgl_mulai_cuti', 'tgl_akhir_cuti'], 'safe'],
            [['alasan_cuti','pengalihan'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_pcuti' => 'Id Pcuti',
            'id' => 'ID',
            'id_jcuti' => 'Jenis Cuti',
            'tgl_pengajuan' => 'Tanggal Pengajuan',
            'tgl_mulai_cuti' => 'Tanggal Mulai Cuti',
            'tgl_akhir_cuti' => 'Tanggal Akhir Cuti',
            'lama_cuti' => 'Lama Cuti/Hari',
            'alasan_cuti' => 'Alasan Cuti',
            'pengalihan' => 'Keterangan Pengalihan Tugas (Optional)',
            'id_atasan' => 'Atasan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJcuti() {
        return $this->hasOne(TJenisCuti::className(), ['id_jcuti' => 'id_jcuti']);
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
    public function getIdAtasan() {
        return $this->hasOne(TJabatan::className(), ['id_jabatan' => 'id_atasan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTDataCutis() {
        return $this->hasMany(TDataCuti::className(), ['id_pcuti' => 'id_pcuti']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTStsPermohonanCutis() {
        return $this->hasMany(TStsPermohonanCuti::className(), ['id_pcuti' => 'id_pcuti']);
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

    public static function ViewDateCuti() {
        $id = Yii::$app->user->id;
        $now = date('Y-m-d', strtotime('0 day'));
        $peg = User::findOne(['id' => $id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $model = TPermohonanCuti::find(['id' => $idkar->id])->all();

        foreach ($model as $value) {
            if ($value->tgl_akhir_cuti > $now) {
                return false;
            } else {
                return true;
            }
    }
    }

    public function ViewKuotaCuti() {

        $id = Yii::$app->user->Id;
        $peg = User::findOne(['id' => $id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $model = TMasterCutiIzin::findOne(['id_karyawan' => $idkar->id]);
        if ($model->kuota_cuti <= 0 && $model->kuota_cuti_n <= 0 && $model->kuota_cuti_m <= 0 && $model->kuota_cuti_k <= 0 && $model->kuota_cuti_d <= 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getJumlahCuti($id) {
        //$id = Yii::$app->user->id;
        $peg = User::findOne(['id' => $id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($jabatan->jabatan == "Wakil Rektor 2") {
            $count1 = TStsPermohonanCuti::find()
                            ->where(['status' => "Confirm Atasan Langsung"])->count();
            $count2 = TStsPermohonanCuti::find()
                            ->where(['id_atasan' => $jabatan->id_jabatan, 'status' => "Belum Dikonfirmasi"])->count();
            $hasil = $count1 + $count2;
            return $hasil;
        } else {
            $count1 = TStsPermohonanCuti::find()
                            ->where(['id_atasan' => $jabatan->id_jabatan, 'status' => "Belum Dikonfirmasi"])->count();
            $count2 = TStsPermohonanCuti::find()
                            ->where(['id_atasan' => $jabatan->id_jabatan, 'status' => "Ditangguhkan"])->count();
            return $count1 + $count2;
        }
    }

    public function getStatusAjukanUlang($id_pcuti) {
        //$peg = PermohonanCuti::model()->findByattributes(['id_pcuti'=> $id_pcuti));
        $stat = TStsPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);
        $peg = User::findOne(['id' => $id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findOne(['id_bawahan' => $idkar->id_jabatan]);

        if ($struk && $stat->status == "Reject Atasan Langsung") {
            return true;
        } else {
            return false;
        }
    }

}
