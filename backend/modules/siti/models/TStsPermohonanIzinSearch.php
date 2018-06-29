<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TStsPermohonanIzin;

/**
 * TStsPermohonanIzinSearch represents the model behind the search form about `backend\modules\siti\models\TStsPermohonanIzin`.
 */
class TStsPermohonanIzinSearch extends TStsPermohonanIzin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_status', 'id_pizin', 'jlh_permohonan', 'id_atasan'], 'integer'],
            [['keterangan', 'status'], 'safe'],
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
        $query = TStsPermohonanIzin::find();

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
            'id_status' => $this->id_status,
            'id_pizin' => $this->id_pizin,
            'jlh_permohonan' => $this->jlh_permohonan,
            'id_atasan' => $this->id_atasan,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
