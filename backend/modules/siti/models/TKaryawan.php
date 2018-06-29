<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "siti_r_pegawai".
 *
 * @property integer $id
 * @property string $nik
 * @property string $nama
 * @property string $email
 * @property string $no_hp
 * @property string $inisial
 * @property string $id_sex
 * @property string $status_kawin
 * @property string $status_kepeg
 * @property integer $id_jabatan
 *
 * @property TKehadiran[] $tKehadirans
 * @property TJabatan $idJabatan
 * @property TMUser[] $tMUsers
 * @property TPermohonanCuti[] $tPermohonanCutis
 * @property TPermohonanIzin[] $tPermohonanIzins
 * @property TMasterCutiIzin[] $TMasterCutiIzins
 */
class TKaryawan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_karyawan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'nama', 'inisial', 'id_sex', 'status_kawin', 'status_kepeg', 'id_jabatan'], 'required'],
            [['id_jabatan'], 'integer'],
            [['id_sex', 'status_kawin'], 'string'],
            [['nik', 'email'], 'string', 'max' => 45],
            [['nama'], 'string', 'max' => 200],
            [['no_hp'], 'string', 'max' => 12],
            [['inisial'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nik' => 'NIK',
            'nama' => 'Nama',
            'email' => 'Email',
            'no_hp' => 'No Hp',
            'inisial' => 'Inisial',
            'id_sex' => 'Jenis Kelamin',
            'status_kawin' => 'Status',
            'status_kepeg' => 'Status Kepegawaian',
            'id_jabatan' => 'Nama Jabatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJabatan()
    {
        return $this->hasOne(TJabatan::className(), ['id_jabatan' => 'id_jabatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['nik' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPermohonanCutis()
    {
        return $this->hasMany(TPermohonanCuti::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPermohonanIzins()
    {
        return $this->hasMany(TPermohonanIzin::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMasterCutiIzins()
    {
        return $this->hasMany(TMasterCutiIzin::className(), ['id_karyawan' => 'id']);
    }

}
