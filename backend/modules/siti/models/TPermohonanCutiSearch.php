<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TPermohonanCuti;

/**
 * TPermohonanCutiSearch represents the model behind the search form about `backend\modules\siti\models\TPermohonanCuti`.
 */
class TPermohonanCutiSearch extends TPermohonanCuti {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_pcuti', 'id', 'id_jcuti', 'lama_cuti', 'id_atasan'], 'integer'],
            [['tgl_pengajuan', 'tgl_mulai_cuti', 'tgl_akhir_cuti', 'alasan_cuti'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = TPermohonanCuti::find();

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
            'id_pcuti' => $this->id_pcuti,
            'id' => $this->id,
            'id_jcuti' => $this->id_jcuti,
            'tgl_pengajuan' => $this->tgl_pengajuan,
            'tgl_mulai_cuti' => $this->tgl_mulai_cuti,
            'tgl_akhir_cuti' => $this->tgl_akhir_cuti,
            'lama_cuti' => $this->lama_cuti,
            'id_atasan' => $this->id_atasan,
        ]);

        $query->andFilterWhere(['like', 'alasan_cuti', $this->alasan_cuti]);

        return $dataProvider;
    }

    public function searchWr2($params) {
        $query = TPermohonanCuti::find();

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
            'id_pcuti' => $this->id_pcuti,
            'id' => $this->id,
            'id_jcuti' => $this->id_jcuti,
            'tgl_pengajuan' => $this->tgl_pengajuan,
            'tgl_mulai_cuti' => $this->tgl_mulai_cuti,
            'tgl_akhir_cuti' => $this->tgl_akhir_cuti,
            'lama_cuti' => $this->lama_cuti,
            'id_atasan' => $this->id_atasan,
        ]);

        $query->andFilterWhere(['like', 'alasan_cuti', $this->alasan_cuti]);

        $query->select([
                    't_permohonancuti.id_pcuti',
                    't_permohonancuti.id',
                    't_permohonancuti.id_jcuti',
                    't_permohonancuti.tgl_pengajuan',
                    't_permohonancuti.tgl_mulai_cuti',
                    't_permohonancuti.tgl_akhir_cuti',
                    't_permohonancuti.lama_cuti',
                    't_permohonancuti.alasan_cuti',
                    't_sts_permohonancuti.status',])
                ->from('t_permohonancuti')
                ->join('INNER JOIN', 't_sts_permohonancuti'
                        , 't_permohonancuti.id_pcuti = t_sts_permohonancuti.id_pcuti')
                ->where('t_sts_permohonancuti.status like "Confirm Atasan Langsung"');

        return $dataProvider;
    }

    public function searchByUser($id) {
        $query = TPermohonanCuti::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_pcuti' => $this->id_pcuti,
            'id' => $id,
            'id_jcuti' => $this->id_jcuti,
            'tgl_pengajuan' => $this->tgl_pengajuan,
            'tgl_mulai_cuti' => $this->tgl_mulai_cuti,
            'tgl_akhir_cuti' => $this->tgl_akhir_cuti,
            'lama_cuti' => $this->lama_cuti,
            'id_atasan' => $this->id_atasan,
        ]);

        $query->andFilterWhere(['like', 'alasan_cuti', $this->alasan_cuti]);

        return $dataProvider;
    }



public function searchMe($id) {
        $query = TPermohonanCuti::find();

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
                        't_permohonancuti.id_pcuti',
                        't_permohonancuti.id',
                        't_permohonancuti.id_jcuti',
                        't_permohonancuti.tgl_pengajuan',
                        't_permohonancuti.tgl_mulai_cuti',
                        't_permohonancuti.tgl_akhir_cuti',
                        't_permohonancuti.lama_cuti',
                        't_permohonancuti.alasan_cuti',
                        't_sts_permohonancuti.status',
                       ])
                    ->from('t_permohonancuti')
                    ->join('INNER JOIN', 't_sts_permohonancuti'
                            , 't_permohonancuti.id_pcuti = t_sts_permohonancuti.id_pcuti')
                    ->where('t_sts_permohonancuti.status like "Belum Dikonfirmasi" and t_sts_permohonancuti.id_atasan='.$idkar->id_jabatan);
       // or t_r_status_permohonancuti.status like "Confirm Atasan Langsung" or t_r_status_permohonancuti.status like "Reject Atasan Langsung"
        return $dataProvider;
    }

    public function searchMe1($id) {
        $query = TPermohonanCuti::find();

        $id = Yii::$app->user->id;
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        $dataProvider1 = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider1;
        }

        $query->select([
                        't_permohonancuti.id_pcuti',
                        't_permohonancuti.id',
                        't_permohonancuti.id_jcuti',
                        't_permohonancuti.tgl_pengajuan',
                        't_permohonancuti.tgl_mulai_cuti',
                        't_permohonancuti.tgl_akhir_cuti',
                        't_permohonancuti.lama_cuti',
                        't_permohonancuti.alasan_cuti',
                     //   't_permohonancuti.id_atasan',
                       ])
                    ->from('t_permohonancuti')
                    ->join('INNER JOIN', 't_sts_permohonancuti'
                            , 't_permohonancuti.id_pcuti = t_sts_permohonancuti.id_pcuti')
                    ->where('t_sts_permohonancuti.status not like "Belum Dikonfirmasi" and t_sts_permohonancuti.status not like "Confirm Wakil Rektor 2" and t_sts_permohonancuti.status not like "Reject Wakil Rektor 2" and t_sts_permohonancuti.status not like "Cancel" and t_sts_permohonancuti.id_atasan='.$idkar->id_jabatan);
       // or t_r_status_permohonancuti.status like "Confirm Atasan Langsung" or t_r_status_permohonancuti.status like "Reject Atasan Langsung"
        return $dataProvider1;
    }

    public function searchMe2($id) {
        $query = TPermohonanCuti::find();

        $id = Yii::$app->user->id;
        $peg = User::findOne(['id' => Yii::$app->user->id]);
        $idkar = TKaryawan::findOne(['nik' => $peg->nik]);
        $struk = TStruktur::findAll(['id_atasan' => $idkar->id_jabatan]);
        $jabatan = TJabatan::findOne(['id_jabatan' => $idkar->id_jabatan]);

        $dataProvider1 = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider1;
        }

        $query->select([
                        't_permohonancuti.id_pcuti',
                        't_permohonancuti.id',
                        't_permohonancuti.id_jcuti',
                        't_permohonancuti.tgl_pengajuan',
                        't_permohonancuti.tgl_mulai_cuti',
                        't_permohonancuti.tgl_akhir_cuti',
                        't_permohonancuti.lama_cuti',
                        't_permohonancuti.alasan_cuti',
                     //   't_permohonancuti.id_atasan',
                       ])
                    ->from('t_permohonancuti')
                    ->join('INNER JOIN', 't_sts_permohonancuti'
                            , 't_permohonancuti.id_pcuti = t_sts_permohonancuti.id_pcuti')
                    ->where('t_sts_permohonancuti.status like "Confirm Wakil Rektor 2" or t_sts_permohonancuti.status like "Reject Wakil Rektor 2"');
       // or t_r_status_permohonancuti.status like "Confirm Atasan Langsung" or t_r_status_permohonancuti.status like "Reject Atasan Langsung"
        return $dataProvider1;
    }

    public function searchkaryawanCuti($params) {
        $query = TPermohonanCuti::find();

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
                        't_permohonancuti.id_pcuti',
                        't_permohonancuti.id',
                        't_permohonancuti.id_jcuti',
                        't_permohonancuti.tgl_pengajuan',
                        't_permohonancuti.tgl_mulai_cuti',
                        't_permohonancuti.tgl_akhir_cuti',
                        't_permohonancuti.lama_cuti',
                        't_permohonancuti.alasan_cuti',
                       ])
                    ->from('t_permohonancuti')
                    ->join('INNER JOIN', 'siti_t_data_cuti'
                            , 't_permohonancuti.id_pcuti = siti_t_data_cuti.id_pcuti')
                    ->where('siti_t_data_cuti.tgl_sah_akhir>='.$now);
       // or t_r_status_permohonancuti.status like "Confirm Atasan Langsung" or t_r_status_permohonancuti.status like "Reject Atasan Langsung"
        return $dataProvider;
    }

}
