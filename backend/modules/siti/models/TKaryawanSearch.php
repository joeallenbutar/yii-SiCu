<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TKaryawan;

/**
 * TKaryawanSearch represents the model behind the search form about `backend\modules\siti\models\TKaryawan`.
 */
class TKaryawanSearch extends TKaryawan {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'id_jabatan'], 'integer'],
            [['nik', 'nama', 'email', 'no_hp', 'inisial', 'id_sex', 'status_kawin', 'd_aw_kerja', 'status_kepeg'], 'safe'],
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
        $query = TKaryawan::find();

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
            'd_aw_kerja' => $this->d_aw_kerja,
            'id_jabatan' => $this->id_jabatan,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
                ->andFilterWhere(['like', 'nama', $this->nama])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'no_hp', $this->no_hp])
                ->andFilterWhere(['like', 'inisial', $this->inisial])
                ->andFilterWhere(['like', 'id_sex', $this->id_sex])
                ->andFilterWhere(['like', 'status_kawin', $this->status_kawin])
                ->andFilterWhere(['like', 'status_kepeg', $this->status_kepeg]);


        return $dataProvider;
    }

}
