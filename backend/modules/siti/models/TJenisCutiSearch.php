<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TJenisCuti;

/**
 * TJenisCutiSearch represents the model behind the search form about `backend\modules\siti\models\TJenisCuti`.
 */
class TJenisCutiSearch extends TJenisCuti
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jcuti'], 'integer'],
            [['nama_cuti', 'lama_cuti', 'keterangan'], 'safe'],
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
        $query = TJenisCuti::find();

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
            'id_jcuti' => $this->id_jcuti,
        ]);

        $query->andFilterWhere(['like', 'nama_cuti', $this->nama_cuti])
            ->andFilterWhere(['like', 'lama_cuti', $this->lama_cuti])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
