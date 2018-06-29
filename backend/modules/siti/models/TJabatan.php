<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "siti_r_jabatan".
 *
 * @property integer $id_jabatan
 * @property string $jabatan
 *
 * @property TKaryawan[] $TKaryawans
 * @property TPermohonanCuti[] $tPermohonanCutis
 * @property TPermohonanIzin[] $tPermohonanIzins
 * @property TStsPermohonanCuti[] $TStsPermohonanCutis
 * @property TStruktur[] $TStrukturs
 */
class TJabatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jabatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jabatan'], 'required'],
            [['jabatan'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jabatan' => 'ID Jabatan',
            'jabatan' => 'Jabatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTKaryawans()
    {
        return $this->hasMany(TKaryawan::className(), ['id_jabatan' => 'id_jabatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPermohonanCutis()
    {
        return $this->hasMany(TPermohonanCuti::className(), ['id_atasan' => 'id_jabatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPermohonanIzins()
    {
        return $this->hasMany(TPermohonanIzin::className(), ['id_atasan' => 'id_jabatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTStsPermohonanCutis()
    {
        return $this->hasMany(TStsPermohonanCuti::className(), ['id_atasan' => 'id_jabatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTStrukturs()
    {
        return $this->hasMany(TStruktur::className(), ['id_bawahan' => 'id_jabatan']);
    }
}
