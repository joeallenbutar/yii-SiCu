<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TPermohonanIzin;

/**
 * TPermohonanIzinSearch represents the model behind the search form about `backend\modules\siti\models\TPermohonanIzin`.
 */
class TPermohonanIzinSearch extends TPermohonanIzin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pizin', 'id', 'id_jizin', 'lama_izin', 'id_atasan'], 'integer'],
            [['tgl_pengajuan', 'alasan_izin', 'tgl_mulai_izin', 'tgl_akhir_izin'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TPermohonanIzin::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_pizin' => $this->id_pizin,
            'id' => $this->id,
            'id_jizin' => $this->id_jizin,
            'tgl_pengajuan' => $this->tgl_pengajuan,
            'lama_izin' => $this->lama_izin,
            'id_atasan' => $this->id_atasan,
            'tgl_mulai_izin' => $this->tgl_mulai_izin,
            'tgl_akhir_izin' => $this->tgl_akhir_izin,
        ]);

        $query->andFilterWhere(['like', 'alasan_izin', $this->alasan_izin]);

        return $dataProvider;
    }

    public function searchByUser($id)
    {
        $query = TPermohonanIzin::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_pizin' => $this->id_pizin,
            'id' => $id,
            'id_jizin' => $this->id_jizin,
            'tgl_pengajuan' => $this->tgl_pengajuan,
            'lama_izin' => $this->lama_izin,
            'id_atasan' => $this->id_atasan,
            'tgl_mulai_izin' => $this->tgl_mulai_izin,
            'tgl_akhir_izin' => $this->tgl_akhir_izin,
        ]);

        $query->andFilterWhere(['like', 'alasan_izin', $this->alasan_izin]);

        return $dataProvider;
    }

    public function searchMe($id) {
        $query = TPermohonanIzin::find();

        $id = Yii::$app->user->id;
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->select([
                        't_permohonanizin.id_pizin',
                        't_permohonanizin.id',
                        't_permohonanizin.id_jizin',
                        't_permohonanizin.tgl_pengajuan',
                        't_permohonanizin.tgl_mulai_izin',
                        't_permohonanizin.tgl_akhir_izin',
                        't_permohonanizin.lama_izin',
                        't_permohonanizin.alasan_izin',
                        ])
                    ->from('t_permohonanizin')
                    ->join('INNER JOIN', 't_sts_permohonanizin'
                            , 't_permohonanizin.id_pizin = t_sts_permohonanizin.id_pizin')
                    ->where('t_sts_permohonanizin.status like "Belum Dikonfirmasi" and t_sts_permohonanizin.id_atasan='.$idkar->id_jabatan);
        return $dataProvider;
    }

    public function searchMe1($id) {
        $query = TPermohonanIzin::find();

        $id = Yii::$app->user->id;
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->select([
                        't_permohonanizin.id_pizin',
                        't_permohonanizin.id',
                        't_permohonanizin.id_jizin',
                        't_permohonanizin.tgl_pengajuan',
                        't_permohonanizin.tgl_mulai_izin',
                        't_permohonanizin.tgl_akhir_izin',
                        't_permohonanizin.lama_izin',
                        't_permohonanizin.alasan_izin',
                        ])
                    ->from('t_permohonanizin')
                    ->join('INNER JOIN', 't_sts_permohonanizin'
                            , 't_permohonanizin.id_pizin = t_sts_permohonanizin.id_pizin')
                    ->where('t_sts_permohonanizin.status not like "Belum Dikonfirmasi" and t_sts_permohonanizin.status not like "Cancel" and t_sts_permohonanizin.id_atasan='.$idkar->id_jabatan);
        return $dataProvider;
    }

    public function searchkaryawanIzin($params) {
        $query = TPermohonanIzin::find();

        $id = Yii::$app->user->id;
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $now = date('Y-m-d', strtotime('0 day'));

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->select([
                        't_permohonanizin.id_pizin',
                        't_permohonanizin.id',
                        't_permohonanizin.id_jizin',
                        't_permohonanizin.tgl_pengajuan',
                        't_permohonanizin.tgl_mulai_izin',
                        't_permohonanizin.tgl_akhir_izin',
                        't_permohonanizin.lama_izin',
                        't_permohonanizin.alasan_izin',
                       ])
                    ->from('t_permohonanizin')
                    ->join('INNER JOIN', 'siti_t_data_izin'
                            , 't_permohonanizin.id_pizin = siti_t_data_izin.id_pizin')
                    ->where('siti_t_data_izin.tgl_sah_akhir>='.$now);
       // or t_r_status_permohonanizin.status like "Confirm Atasan Langsung" or t_r_status_permohonanizin.status like "Reject Atasan Langsung"
        return $dataProvider;
    }

}
