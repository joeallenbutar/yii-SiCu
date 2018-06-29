<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "siti_t_data_izin".
 *
 * @property integer $id_izin
 * @property integer $id_pizin
 * @property string $tgl_sah
 * @property integer $lama_sah
 * @property string $tgl_sah_mulai
 * @property string $tgl_sah_akhir
 * @property string $catatan
 *
 * @property TPermohonanIzin $idPizin
 */
class TDataIzin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_dataizin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id_pizin', 'tgl_sah', 'lama_sah', 'tgl_sah_mulai', 'tgl_sah_akhir'], 'required'],
            [['id_pizin', 'lama_sah'], 'integer'],
            [['tgl_sah', 'tgl_sah_mulai', 'tgl_sah_akhir'], 'safe'],
            [['catatan'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_izin' => 'Id Izin',
            'id_pizin' => 'Id Pizin',
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
    public function getIdPizin()
    {
        return $this->hasOne(TPermohonanIzin::className(), ['id_pizin' => 'id_pizin']);
    }
}
