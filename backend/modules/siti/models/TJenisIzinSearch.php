<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TRJenisIzin;

/**
 * TRJenisIzinSearch represents the model behind the search form about `backend\modules\siti\models\TRJenisIzin`.
 */
class TRJenisIzinSearch extends TRJenisIzin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jizin', 'lama_izin'], 'integer'],
            [['nama_izin', 'keterangan'], 'safe'],
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
        $query = TRJenisIzin::find();

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
            'id_jizin' => $this->id_jizin,
            'lama_izin' => $this->lama_izin,
        ]);

        $query->andFilterWhere(['like', 'nama_izin', $this->nama_izin])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
