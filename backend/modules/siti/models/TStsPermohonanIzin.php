<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "t_sts_permohonanizin".
 *
 * @property integer $id_status
 * @property integer $id_pizin
 * @property integer $jlh_permohonan
 * @property integer $id_atasan
 * @property string $keterangan
 * @property string $status
 * @property string $alasan_reject
 *
 * @property TPermohonanIzin $idPizin
 */
class TStsPermohonanIzin extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 't_sts_permohonanizin';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_pizin', 'id_atasan', 'status'], 'required'],
            [['id_pizin', 'jlh_permohonan', 'id_atasan'], 'integer'],
            [['keterangan','alasan_reject'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_status' => 'ID Status',
            'id_pizin' => 'Permohonan Izin',
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
    public function getIdPizin() {
        return $this->hasOne(TPermohonanIzin::className(), ['id_pizin' => 'id_pizin']);
    }

    public function getStatusKonfirm($id_pizin) {

        $stat = TStsPermohonanIzin::findOne(['id_pizin' => $id_pizin]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($struk && $stat->id_atasan==$idkar->id_jabatan) {
            return true;
        } else if (($struk && $jabatan->jabatan == "Wakil Rektor 2")) {
            return true;
        } else {
            return false;
        }
    }

    public function getStatusCetak($id_pizin) {

        $stat = TStsPermohonanIzin::findOne(['id_pizin' => $id_pizin]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $idper = TPermohonanIzin::findOne(['id_pizin' => $id_pizin]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($idkar->id == $idper->id && $stat->status == "Confirm Atasan Langsung") {
            return true;
        }else if ($struk && $jabatan->jabatan == "HRD") {
         return true;
        } else {
            return false;
        }
    }

    public function getStatusHRD($id_pizin) {
        //$peg = PermohonanIzin::model()->findByattributes(array('id_pizin'=> $id_pizin));
        $stat = TStsPermohonanIzin::findOne(['id_pizin' => $id_pizin]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($jabatan->jabatan == "HRD") {
            return true;
        } else {
            return false;
        }
    }

    public function getStatusAkhiri($id_pizin) {
        //$peg = PermohonanIzin::model()->findByattributes(array('id_pizin'=> $id_pizin));
        $stat = TStsPermohonanIzin::findOne(['id_pizin' => $id_pizin]);
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $idper = TPermohonanIzin::findOne(['id_pizin' => $id_pizin]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        if ($idkar->id == $idper->id && $stat->status == "Belum Dikonfirmasi") {
            return true;
        } else {
            return false;
        }
    }

}
