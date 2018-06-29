<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "siti_r_jenis_cuti".
 *
 * @property integer $id_jcuti
 * @property string $nama_cuti
 * @property integer $lama_cuti
 * @property string $keterangan
 *
 * @property TPermohonanCuti[] $tPermohonanCutis
 */
class TJenisCuti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jeniscuti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_cuti', 'lama_cuti', 'keterangan'], 'required'],
            [['lama_cuti'], 'integer'],
            [['nama_cuti'], 'string', 'max' => 30],
            [['keterangan'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jcuti' => 'Id Jcuti',
            'nama_cuti' => 'Nama Cuti',
            'lama_cuti' => 'Lama Cuti/Hari',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPermohonanCutis()
    {
        return $this->hasMany(TPermohonanCuti::className(), ['id_jcuti' => 'id_jcuti']);
    }
}
