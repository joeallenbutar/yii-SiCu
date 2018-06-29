<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "siti_r_detail_cuti_izin".
 *
 * @property integer $id
 * @property integer $kuota_cuti
 * @property integer $kuota_cuti_n
 * @property integer $kuota_cuti_m
 * @property integer $kuota_cuti_k
 * @property integer $kuota_cuti_d
 * @property integer $jlh_izin
 * @property integer $lama_kerja
 * @property integer $id_karyawan
 *
 * @property TKaryawan $idkaryawan
 */
class TMasterCutiIzin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_mastercuti_izin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['kuota_cuti', 'jlh_izin', 'lama_kerja', 'id_karyawan'], 'required'],
            [['kuota_cuti', 'jlh_izin', 'lama_kerja', 'id_karyawan','kuota_cuti_n','kuota_cuti_m','kuota_cuti_k','kuota_cuti_d'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kuota_cuti' => 'Kuota Cuti Tahunan',
            'kuota_cuti_n' => 'Kuota Cuti Nikah',
            'kuota_cuti_m' => 'Kuota Cuti Melahirkan',
            'kuota_cuti_k' => 'Kuota Cuti Keguguran',
            'kuota_cuti_d' => 'Kuota Cuti Diluar Tanggungan',
            'jlh_izin' => 'Jumlah Izin',
            'lama_kerja' => 'Lama Kerja',
            'id_karyawan' => 'Nama karyawan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdkaryawan()
    {
        return $this->hasOne(TKaryawan::className(), ['id' => 'id_karyawan']);
    }
}
