<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "t_sts_permohonancuti".
 *
 * @property integer $id_status
 * @property integer $id_pcuti
 * @property integer $jlh_permohonan
 * @property integer $id_atasan
 * @property string $keterangan
 * @property string $status
 * @property string $alasan_reject
 *
 * @property TJabatan $idAtasan
 * @property TPermohonanCuti $idPcuti
 */
class TStsPermohonanCuti extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 't_sts_permohonancuti';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_pcuti','id_atasan','status'], 'required'],
            [['id_pcuti', 'jlh_permohonan', 'id_atasan'], 'integer'],
            [['keterangan','alasan_reject'], 'string', 'max' => 250],
            [['status'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_status' => 'ID Status',
            'id_pcuti' => 'Permohonan Cuti',
            'jlh_permohonan' => 'Jumlah Permohonan',
            'id_atasan' => 'Atasan',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
            'alasan_reject' => 'Alasan Reject Request (Optional)',
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
    public function getIdPcuti() {
        return $this->hasOne(TPermohonanCuti::className(), ['id_pcuti' => 'id_pcuti']);
    }

    public function getStatusKonfirm($id_pcuti) {
        $stat = TStsPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);
        $idper = TPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findOne(['id_bawahan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($struk && $stat->id_atasan==$idkar->id_jabatan) {
            return true;
        } else if ($jabatan->jabatan == "HRD" && $idper->id!=$idkar->id) {
            return true;
        } else {
            return false;
        }
    }

    public function getStatusKonfirmWR2($id_pcuti) {
        $stat = TStsPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($jabatan->jabatan == "Wakil Rektor 2" || $jabatan->jabatan == "HRD") {
            return true;
        } else {
            return false;
        }
    }

    public function getStatusCetak($id_pcuti) {
        $stat = TStsPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $idper = TPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($idkar->id == $idper->id && $stat->status == "Confirm Wakil Rektor 2") {
            return true;
        }else if ($jabatan->jabatan == "HRD" && $stat->status == "Confirm Wakil Rektor 2")  {
         return true;
        } else {
            return false;
        }
    }

    public function getStatusHRD($id_pcuti) {
        $stat = TStsPermohonanCuti::findAll(['id_pcuti' => $id_pcuti]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);
        $stat = TStsPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);

        if ($jabatan->jabatan == "HRD") {
            return true;
        } else {
            return false;
        }
    }

    public function getStatusAkhiri($id_pcuti) {
        $stat = TStsPermohonanCuti::findAll(['id_pcuti' => $id_pcuti]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);
        $stat = TStsPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);
        $idper = TPermohonanCuti::findOne(['id_pcuti' => $id_pcuti]);

        if ($idkar->id == $idper->id && ($stat->status == "Belum Dikonfirmasi")) {
            return true;
        } else {
            return false;
        }
    }

}
