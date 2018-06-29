<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "siti_r_jenis_izin".
 *
 * @property integer $id_jizin
 * @property string $nama_izin
 * @property integer $lama_izin
 * @property string $keterangan
 *
 * @property TPermohonanIzin[] $tPermohonanIzins
 */
class TJenisIzin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jenisizin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_izin', 'lama_izin', 'keterangan'], 'required'],
            [['lama_izin'], 'integer'],
            [['nama_izin'], 'string', 'max' => 50],
            [['keterangan'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jizin' => 'Id Jizin',
            'nama_izin' => 'Nama Izin',
            'lama_izin' => 'Lama Izin/Hari',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPermohonanIzins()
    {
        return $this->hasMany(TPermohonanIzin::className(), ['id_jizin' => 'id_jizin']);
    }
}
