<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "siti_r_struktur".
 *
 * @property integer $id_struktur
 * @property integer $id_atasan
 * @property integer $id_bawahan
 *
 * @property TJabatan $idAtasan
 * @property TJabatan $idBawahan
 */
class TStruktur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_struktur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_atasan', 'id_bawahan'], 'required'],
            [['id_atasan', 'id_bawahan'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_struktur' => 'Id Struktur',
            'id_atasan' => 'Atasan',
            'id_bawahan' => 'Bawahan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAtasan()
    {
        return $this->hasOne(TJabatan::className(), ['id_jabatan' => 'id_atasan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBawahan()
    {
        return $this->hasOne(TJabatan::className(), ['id_jabatan' => 'id_bawahan']);
    }
}
