<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TMasterCutiIzin;

/**
 * TMasterCutiIzinSearch represents the model behind the search form about `backend\modules\siti\models\TMasterCutiIzin`.
 */
class TMasterCutiIzinSearch extends TMasterCutiIzin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kuota_cuti','kuota_cuti_n','kuota_cuti_m','kuota_cuti_k','kuota_cuti_d','jlh_izin', 'lama_kerja', 'id_karyawan'], 'integer'],
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
        $query = TMasterCutiIzin::find();

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
            'id' => $this->id,
            'kuota_cuti' => $this->kuota_cuti,
            'kuota_cuti_n' => $this->kuota_cuti_n,
            'kuota_cuti_m' => $this->kuota_cuti_m,
            'kuota_cuti_k' => $this->kuota_cuti_k,
            'kuota_cuti_d' => $this->kuota_cuti_d,
            'jlh_izin' => $this->jlh_izin,
            'lama_kerja' => $this->lama_kerja,
            'id_karyawan' => $this->id_karyawan,
        ]);

        return $dataProvider;
    }

    public function searchByUser($id)
    {
        $query = TMasterCutiIzin::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'kuota_cuti' => $this->kuota_cuti,
            'kuota_cuti_n' => $this->kuota_cuti_n,
            'kuota_cuti_m' => $this->kuota_cuti_m,
            'kuota_cuti_k' => $this->kuota_cuti_k,
            'kuota_cuti_d' => $this->kuota_cuti_d,
            'jlh_izin' => $this->jlh_izin,
            'lama_kerja' => $this->lama_kerja,
            'id_karyawan' => $id,
        ]);

        return $dataProvider;
    }

}
