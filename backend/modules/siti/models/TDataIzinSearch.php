<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TDataIzin;

/**
 * TDataIzinSearch represents the model behind the search form about `backend\modules\siti\models\TDataIzin`.
 */
class TDataIzinSearch extends TDataIzin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_izin', 'id_pizin', 'lama_sah'], 'integer'],
            [['tgl_sah', 'tgl_sah_mulai', 'tgl_sah_akhir', 'catatan'], 'safe'],
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
        $query = TDataIzin::find();

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
            'id_izin' => $this->id_izin,
            'id_pizin' => $this->id_pizin,
            'tgl_sah' => $this->tgl_sah,
            'lama_sah' => $this->lama_sah,
            'tgl_sah_mulai' => $this->tgl_sah_mulai,
            'tgl_sah_akhir' => $this->tgl_sah_akhir,
        ]);

        $query->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
