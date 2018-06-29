<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "siti_t_data_cuti".
 *
 * @property integer $id_cuti
 * @property integer $id_pcuti
 * @property string $tgl_sah
 * @property integer $lama_sah
 * @property string $tgl_sah_mulai
 * @property string $tgl_sah_akhir
 * @property string $catatan
 *
 * @property TPermohonanCuti $idPcuti
 */
class TDataCuti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_datacuti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id_pcuti', 'tgl_sah', 'lama_sah', 'tgl_sah_mulai', 'tgl_sah_akhir'], 'required'],
            [['id_pcuti', 'lama_sah'], 'integer'],
            [['tgl_sah', 'tgl_sah_mulai', 'tgl_sah_akhir'], 'safe'],
            [['catatan'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cuti' => 'Id Cuti',
            'id_pcuti' => 'Id Pcuti',
            'tgl_sah' => 'Tgl Sah',
            'lama_sah' => 'Lama Sah',
            'tgl_sah_mulai' => 'Tgl Sah Mulai',
            'tgl_sah_akhir' => 'Tgl Sah Akhir',
            'catatan' => 'Catatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPcuti()
    {
        return $this->hasOne(TPermohonanCuti::className(), ['id_pcuti' => 'id_pcuti']);
    }
}
